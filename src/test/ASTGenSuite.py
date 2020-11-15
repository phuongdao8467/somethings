import unittest
from TestUtils import TestAST
from AST import *

class ASTGenSuite(unittest.TestCase):
    def test_simple_program(self):
        """Simple program: int main() {} """
        input = """Var:x[3]=1,y;
    """
        expect = """Program([VarDecl(Id(x),[IntLiteral(1),IntLiteral(2)],IntLiteral(1)),VarDecl(Id(y))])"""
        self.assertTrue(TestAST.checkASTGen(input,expect,300))
    def test2(self):
        
        input = """
Var: a[2] = 2;        
Function: main
Body:
Var:a = {1,2,3,4}, b =1;
If n == 0 Then
n[12] = 3 + x;
ElseIf n == 1 Then
n[11] = 3 - v;
Else
fact (n - 1);

EndIf.
EndBody."""
        expect = """"""
        self.assertTrue(TestAST.checkASTGen(input,expect,301))
 
   