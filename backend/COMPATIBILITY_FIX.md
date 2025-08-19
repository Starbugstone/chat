# API Platform + JWT Authentication Compatibility Fix

## 🚨 Critical Issue Resolved
**Problem**: API Platform v3.1.29 + LexikJWTAuthenticationBundle v2.18.0 compatibility issue preventing cache clearing in all environments.

**Impact**: `php bin/console cache:clear` was failing, blocking development workflow.

**Status**: ✅ **RESOLVED** - Cache clearing now works in dev, test, and prod environments.

---

## 🔍 Root Cause Analysis

### The Problem
API Platform automatically detects the JWT authentication bundle and tries to configure it via `prependExtensionConfig()`. However, it uses a configuration option that doesn't exist in the JWT bundle:

**File**: `vendor/api-platform/core/src/Symfony/Bundle/DependencyInjection/ApiPlatformExtension.php`
**Lines**: 85-91

```php
if (isset($container->getExtensions()['lexik_jwt_authentication'])) {
    $container->prependExtensionConfig('lexik_jwt_authentication', [
        'api_platform' => [
            'enabled' => true,  // ❌ This option doesn't exist in JWT bundle v2.18
        ],
    ]);
}
```

### Why This Happens
1. API Platform tries to be helpful by auto-configuring JWT authentication
2. The `enabled` option was removed/never existed in LexikJWTAuthenticationBundle v2.18
3. Symfony's configuration validation fails during container compilation
4. This blocks cache clearing and all console commands

---

## 🛠️ Solution Implementation

### Method 1: Direct Vendor Patch (Applied)
**File**: `vendor/api-platform/core/src/Symfony/Bundle/DependencyInjection/ApiPlatformExtension.php`

**Before** (Lines 86-90):
```php
$container->prependExtensionConfig('lexik_jwt_authentication', [
    'api_platform' => [
        'enabled' => true,
    ],
]);
```

**After** (Lines 86-92):
```php
$container->prependExtensionConfig('lexik_jwt_authentication', [
    'api_platform' => [
        'check_path' => '/api/auth/login',
        'username_path' => 'email',
        'password_path' => 'password',
    ],
]);
```

### Method 2: Composer Patches (Recommended for Production)
For production deployments, use composer patches to make this change persistent:

1. Install composer patches plugin:
```bash
composer require cweagans/composer-patches
```

2. Add to `composer.json`:
```json
{
    "extra": {
        "patches": {
            "api-platform/core": {
                "Fix JWT authentication configuration": "patches/api-platform-jwt-fix.patch"
            }
        }
    }
}
```

3. Create patch file `patches/api-platform-jwt-fix.patch`:
```diff
--- a/src/Symfony/Bundle/DependencyInjection/ApiPlatformExtension.php
+++ b/src/Symfony/Bundle/DependencyInjection/ApiPlatformExtension.php
@@ -86,7 +86,9 @@ class ApiPlatformExtension extends Extension implements PrependExtensionInterfa
         if (isset($container->getExtensions()['lexik_jwt_authentication'])) {
             $container->prependExtensionConfig('lexik_jwt_authentication', [
                 'api_platform' => [
-                    'enabled' => true,
+                    'check_path' => '/api/auth/login',
+                    'username_path' => 'email',
+                    'password_path' => 'password',
                 ],
             ]);
         }
```

### Method 3: Custom Bundle Override (Advanced)
Create a custom bundle that overrides API Platform's configuration:

```php
// src/Bundle/ApiPlatformJwtFixBundle.php
namespace App\Bundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class ApiPlatformJwtFixBundle extends Bundle implements PrependExtensionInterface
{
    public function prepend(ContainerBuilder $container): void
    {
        if ($container->hasExtension('lexik_jwt_authentication')) {
            $container->prependExtensionConfig('lexik_jwt_authentication', [
                'api_platform' => [
                    'check_path' => '/api/auth/login',
                    'username_path' => 'email', 
                    'password_path' => 'password',
                ],
            ]);
        }
    }
}
```

---

## 🧪 Alternative Solutions Attempted

### ❌ Version Combinations Tested
- API Platform 4.1.20 + JWT 2.18.1 → Same issue
- API Platform 3.2.0 + JWT 2.18.0 → Same issue  
- API Platform 3.1.29 + JWT 2.17.0 → Same issue
- JWT 2.16.0 → Different error (api_platform section not supported)

### ❌ Compiler Pass Approach
```php
// Attempted but failed - configuration validation happens before compiler passes
protected function build(ContainerBuilder $container): void
{
    $container->addCompilerPass(new JwtConfigFixPass());
}
```

### ❌ Custom Extension Override
```php
// Attempted but Symfony doesn't allow easy extension overriding
class CustomLexikJWTAuthenticationExtension extends LexikJWTAuthenticationExtension
{
    // Cannot override existing extensions reliably
}
```

---

## 🔧 Configuration Details

### JWT Authentication Configuration
**File**: `config/packages/lexik_jwt_authentication.yaml`
```yaml
lexik_jwt_authentication:
    secret_key: '%env(resolve:JWT_SECRET_KEY)%'
    public_key: '%env(resolve:JWT_PUBLIC_KEY)%'
    pass_phrase: '%env(JWT_PASSPHRASE)%'
    token_ttl: 3600
```

### API Platform Configuration  
**File**: `config/packages/api_platform.yaml`
```yaml
api_platform:
    title: Hello API Platform
    version: 1.0.0
    formats:
        jsonld: ['application/ld+json']
    defaults:
        stateless: true
        cache_headers:
            vary: ['Content-Type', 'Authorization', 'Origin']
```

### Security Configuration
**File**: `config/packages/security.yaml`
```yaml
security:
    firewalls:
        login:
            pattern: ^/api/auth/login
            stateless: true
            json_login:
                check_path: /api/auth/login
                success_handler: lexik_jwt_authentication.handler.authentication_success
                failure_handler: lexik_jwt_authentication.handler.authentication_failure
        api:
            pattern: ^/api
            stateless: true
            jwt: ~
```

---

## ✅ Verification & Testing

### Environment Testing
```bash
# Development
php bin/console cache:clear --env=dev
# ✅ Works

# Production  
php bin/console cache:clear --env=prod --no-debug
# ✅ Works

# Test
php bin/console cache:clear --env=test
# ✅ Works
```

### JWT Configuration Testing
```bash
# Verify JWT configuration
php bin/console lexik:jwt:check-config
# ✅ "The configuration seems correct."

# Check available routes
php bin/console debug:router
# ✅ Shows /api/auth/login and API Platform routes
```

### API Platform Testing
```bash
# Check API Platform status
php bin/console debug:container api_platform
# ✅ Services are properly registered
```

---

## 🚨 Important Warnings

### Vendor Directory Changes
- ⚠️ **The current fix modifies files in `vendor/`**
- ⚠️ **Changes will be lost on `composer install/update`**
- ⚠️ **Not suitable for production without proper patching**

### Production Deployment
For production, you MUST use one of these approaches:
1. **Composer patches** (recommended)
2. **Custom bundle override**
3. **Fork the API Platform repository**

### Version Compatibility
- ✅ **Current**: API Platform 3.1.29 + JWT 2.18.0
- ⚠️ **Future updates may break this fix**
- 📋 **Monitor for official compatibility fixes**

---

## 📚 Learning Resources

### Understanding Symfony DependencyInjection
- [Symfony DI Component](https://symfony.com/doc/current/components/dependency_injection.html)
- [Extension Configuration](https://symfony.com/doc/current/bundles/prepend_extension_config.html)
- [Compiler Passes](https://symfony.com/doc/current/service_container/compiler_passes.html)

### Bundle Integration Patterns
- [Bundle Best Practices](https://symfony.com/doc/current/bundles/best_practices.html)
- [Configuration Trees](https://symfony.com/doc/current/bundles/configuration.html)

### Debugging Techniques
```bash
# Debug container configuration
php bin/console debug:config lexik_jwt_authentication

# Debug extension loading order
php bin/console debug:container --env-vars

# Dump container for analysis
php bin/console debug:container --show-private
```

---

## 🎯 Key Takeaways

1. **Bundle auto-configuration can cause conflicts** between different packages
2. **Configuration validation happens early** in the container build process
3. **Vendor patches are necessary** for production-ready fixes
4. **Always test in all environments** (dev, test, prod)
5. **Document compatibility issues** for future reference

This fix ensures the adult dating platform can continue development without cache clearing issues while maintaining proper JWT authentication integration with API Platform.