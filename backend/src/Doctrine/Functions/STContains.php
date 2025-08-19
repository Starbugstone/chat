<?php

namespace App\Doctrine\Functions;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\SqlWalker;

class STContains extends FunctionNode
{
    private $firstGeometry;
    private $secondGeometry;

    public function getSql(SqlWalker $sqlWalker): string
    {
        return 'ST_Contains(' .
            $this->firstGeometry->dispatch($sqlWalker) . ', ' .
            $this->secondGeometry->dispatch($sqlWalker) .
            ')';
    }

    public function parse(Parser $parser): void
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->firstGeometry = $parser->ArithmeticPrimary();
        $parser->match(Lexer::T_COMMA);
        $this->secondGeometry = $parser->ArithmeticPrimary();
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }
}