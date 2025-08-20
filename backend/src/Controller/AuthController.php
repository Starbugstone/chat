<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api/auth')]
class AuthController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private UserPasswordHasherInterface $passwordHasher,
        private ValidatorInterface $validator,
        private UserRepository $userRepository
    ) {
    }

    #[Route('/register', name: 'auth_register', methods: ['POST'])]
    public function register(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $user = new User();
        $user->setEmail($data['email'] ?? null);
        $user->setPassword($data['password'] ?? null);
        if (isset($data['dateOfBirth'])) {
            try {
                $user->setDateOfBirth(new \DateTime($data['dateOfBirth']));
            } catch (\Exception $e) {
                // Do nothing, validator will catch it
            }
        }

        $errors = $this->validator->validate($user);

        if (count($errors) > 0) {
            $errorMessages = [];
            foreach ($errors as $error) {
                $errorMessages[$error->getPropertyPath()][] = $error->getMessage();
            }

            return $this->json([
                'error' => [
                    'code' => 'VALIDATION_ERROR',
                    'message' => 'Validation failed',
                    'details' => $errorMessages,
                    'timestamp' => (new \DateTime())->format('c')
                ]
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // Hash password
        $hashedPassword = $this->passwordHasher->hashPassword($user, $user->getPassword());
        $user->setPassword($hashedPassword);

        // Generate email verification token
        $verificationToken = bin2hex(random_bytes(32));
        $user->setEmailVerificationToken($verificationToken);
        $user->setEmailVerificationExpiresAt(new \DateTime('+24 hours'));

        // Save user
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        // Send verification email
        $this->emailService->sendVerificationEmail($user);

        return $this->json([
            'message' => 'User registered successfully. Please check your email for verification.',
            'user' => [
                'id' => $user->getId(),
                'email' => $user->getEmail(),
                'isEmailVerified' => $user->isEmailVerified(),
                'createdAt' => $user->getCreatedAt()->format('c')
            ],
            'verificationToken' => $verificationToken // TODO: Remove in production, send via email
        ], Response::HTTP_CREATED);
    }

    #[Route('/verify-email', name: 'auth_verify_email', methods: ['POST'])]
    public function verifyEmail(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!isset($data['token'])) {
            return $this->json([
                'error' => [
                    'code' => 'MISSING_TOKEN',
                    'message' => 'Verification token is required',
                    'timestamp' => (new \DateTime())->format('c')
                ]
            ], Response::HTTP_BAD_REQUEST);
        }

        $user = $this->userRepository->findOneBy(['emailVerificationToken' => $data['token']]);

        if (!$user) {
            return $this->json([
                'error' => [
                    'code' => 'INVALID_TOKEN',
                    'message' => 'Invalid verification token',
                    'timestamp' => (new \DateTime())->format('c')
                ]
            ], Response::HTTP_BAD_REQUEST);
        }

        // Check if token is expired
        if ($user->getEmailVerificationExpiresAt() < new \DateTime()) {
            return $this->json([
                'error' => [
                    'code' => 'TOKEN_EXPIRED',
                    'message' => 'Verification token has expired',
                    'timestamp' => (new \DateTime())->format('c')
                ]
            ], Response::HTTP_BAD_REQUEST);
        }

        // Verify email
        $user->setEmailVerified(true);
        $user->setEmailVerificationToken(null);
        $user->setEmailVerificationExpiresAt(null);

        $this->entityManager->flush();

        return $this->json([
            'message' => 'Email verified successfully',
            'user' => [
                'id' => $user->getId(),
                'email' => $user->getEmail(),
                'isEmailVerified' => $user->isEmailVerified()
            ]
        ]);
    }

    #[Route('/me', name: 'auth_me', methods: ['GET'])]
    public function me(): JsonResponse
    {
        $user = $this->getUser();

        if (!$user) {
            return $this->json([
                'error' => [
                    'code' => 'NOT_AUTHENTICATED',
                    'message' => 'User not authenticated',
                    'timestamp' => (new \DateTime())->format('c')
                ]
            ], Response::HTTP_UNAUTHORIZED);
        }

        return $this->json([
            'user' => [
                'id' => $user->getId(),
                'email' => $user->getEmail(),
                'roles' => $user->getRoles(),
                'tokenBalance' => $user->getTokenBalance(),
                'isEmailVerified' => $user->isEmailVerified(),
                'isActive' => $user->isActive(),
                'createdAt' => $user->getCreatedAt()->format('c'),
                'lastActiveAt' => $user->getLastActiveAt()?->format('c')
            ]
        ]);
    }
}