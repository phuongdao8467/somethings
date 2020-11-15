from BKITVisitor import BKITVisitor
from BKITParser import BKITParser
from AST import *
from functools import reduce
class ASTGeneration(BKITVisitor):
    def visitProgram(self,ctx:BKITParser.ProgramContext):
        #return Program([VarDecl(Id(ctx.ID().getText()),[],None)])
        return Program(ctx.declList().accept(self))

    def visitDeclList(self, ctx:BKITParser.DeclListContext):
        if ctx.getChildCount() == 1:
            return self.visit(ctx.decl())
        return self.visit(ctx.decl()) + self.visit(ctx.declList())

    def visitDecl(self,ctx:BKITParser.DeclContext):
        if ctx.var():
            return self.visit(ctx.var())
        return self.visit(ctx.funcDec())

    def visitVar(self,ctx:BKITParser.VarContext):
        return [self.visit(i) for i in ctx.varList()]
        

    def visitVarList(self, ctx:BKITParser.VarListContext):
        if not ctx.getChildCount():
            return []
        if ctx.INT():
            if ctx.typeLit():
                return VarDecl(Id(ctx.ID().getText()), [IntLiteral(i.getText()) for i in ctx.INT()], self.visit(ctx.typeLit()))
            else:
                return VarDecl(Id(ctx.ID().getText()), [IntLiteral(i.getText()) for i in ctx.INT()], self.visit(ctx.array()))

        if ctx.ID():
            if ctx.EQ():
                if ctx.typeLit():
                    return VarDecl(Id(ctx.ID().getText()), [], self.visit(ctx.typeLit()))
                return VarDecl(Id(ctx.ID().getText()), [], self.visit(ctx.array()))
            else:
                return VarDecl(Id(ctx.ID().getText()), [], None)
        
    def visitFuncDec(self, ctx:BKITParser.FuncDecContext):
        param = [self.visit(i) for i in ctx.varList()] if ctx.Parameter() else []
        bodyVar = self.visit(ctx.var()) if ctx.var() else []
        bodyState = [self.visit(i) for i in ctx.statementList()] if ctx.statementList() else []
        body = [bodyVar,bodyState]
        #body = tuple(bodyVar + bodyState)
        body = tuple(body)
        return [FuncDecl(Id(ctx.ID().getText()), param, body)]

    def visitStatementList(self, ctx: BKITParser.StatementListContext):
        if ctx.ifState():
            return self.visit(ctx.ifState())
        if ctx.assignment():
            return self.visit(ctx.assignment())
        if ctx.forState():
            return self.visit(ctx.forState())
        if ctx.whileState():
            return self.visit(ctx.whileState())
        if ctx.doWhileState():
            return self.visit(ctx.doWhileState())
        if ctx.breakState():
            return self.visit(ctx.breakState())
        if ctx.continueState():
            return self.visit(ctx.continueState())
        if ctx.callState():
            return self.visit(ctx.callState())
        if ctx.returnState():
            return self.visit(ctx.returnState())


    def visitAssignment(self, ctx:BKITParser.AssignmentContext):
        lhs = Id(ctx.ID().getText()) if ctx.ID() else self.visit(ctx.indexVar())
        rhs = self.visit(ctx.exp1())
        return Assign(lhs, rhs)

    def visitIfState(self, ctx:BKITParser.IfStateContext):
        exp = [self.visit(i) for i in ctx.exp1()]
        #a = len(exp)
        ifBodyList = [self.visit(i) for i in ctx.stmtBody()]
        ifStmt = [ tuple([exp[i]] + ifBodyList[i])  for i in range(len(exp)) ]
        elseStmt = ifBodyList[-1] if len(ifBodyList) - len(exp) == 1 else [] if len(ifBodyList) == len(exp) else ifBodyList[len(exp):-1]
        #elseStmtTuple = tuple(elseStmt)
        return If(ifStmt, tuple(elseStmt))

    def visitStmtBody(self, ctx:BKITParser.StmtBodyContext):
        var = self.visit(ctx.var()) if ctx.var() else []
        stmt = [self.visit(i) for i in ctx.statementList()] if ctx.statementList() else []
        return [var, stmt]

    def visitForState(self, ctx:BKITParser.ForStateContext):
        idx1 = Id(ctx.ID().getText()) if ctx.ID() else self.visit(ctx.indexVar())
        exp1 = self.visit(ctx.exp1(0))
        exp2 = self.visit(ctx.exp1(1))
        exp3 = self.visit(ctx.exp3())
        loop = self.visit(ctx.stmtBody())
        return For(idx1, exp1, exp2, exp3, tuple(loop))

    # def visitForAssignment(self, ctx:BKITParser.ForAssignmentContext):
    #     return None

    def visitWhileState(self, ctx:BKITParser.WhileStateContext):
        exp = self.visit(ctx.exp1())
        sl = self.visit(ctx.stmtBody())
        return While(exp, tuple(sl))

    def visitDoWhileState(self, ctx:BKITParser.DoWhileStateContext):
        sl = self.visit(ctx.stmtBody())
        exp = self.visit(ctx.exp1())
        return DoWhile(tuple(sl), exp)

    def visitBreakState(self, ctx:BKITParser.BreakStateContext):
        return Break()

    def visitContinueState(self,ctx:BKITParser.ContinueStateContext):
        return Continue()

    def visitCallState(self, ctx:BKITParser.CallStateContext):
        return self.visit(ctx.funcCall())

    def visitReturnState(self, ctx:BKITParser.ReturnStateContext):
        return Return(self.visit(ctx.exp1()))

    def visitFuncCall(self, ctx:BKITParser.FuncCallContext):
        method = Id(ctx.ID().getText())
        param = [self.visit(i) for i in ctx.exp1()]
        return CallStmt(method, param)

    def visitExp1(self, ctx:BKITParser.Exp1Context):
        if ctx.getChildCount() == 1:
            return self.visit(ctx.exp2(0))
        #op = None
        if ctx.Equals():
            op = ctx.Equals().getText()
        elif ctx.NEqualsInt():
            op = ctx.NEqualsInt().getText()
        elif ctx.LTInt():
            op = ctx.LTInt().getText()
        elif ctx.LTEqualsInt():
            op = ctx.LTEqualsInt().getText()
        elif ctx.GTInt():
            op = ctx.GTInt().getText()
        elif ctx.GTEqualsInt():
            op = ctx.GTEqualsInt().getText()
        elif ctx.NEqualsFloat():
            op = ctx.NEqualsFloat().getText()
        elif ctx.LTFloat():
            op = ctx.LTFloat().getText()
        elif ctx.LTEqualsFloat():
            op = ctx.LTEqualsFloat().getText()
        elif ctx.GTFloat():
            op = ctx.GTFloat().getText()
        elif ctx.GTEqualsFloat():
            op = ctx.GTEqualsFloat().getText()
        
        return BinaryOp(op, self.visit(ctx.exp2(0)), self.visit(ctx.exp2(1)))
    
    def visitExp2(self, ctx:BKITParser.Exp2Context):
        if ctx.getChildCount() == 1:
            return self.visit(ctx.exp3())
        op = ctx.And().getText() if ctx.And().getText() else ctx.Or().getText()
        return BinaryOp(op, self.visit(ctx.exp2()), self.visit(ctx.exp3()))

    def visitExp3(self, ctx:BKITParser.Exp3Context):
        if ctx.getChildCount() == 1:
            return self.visit(ctx.exp4())
        if ctx.AddFloat():
            op = ctx.AddFloat().getText()
        elif ctx.AddInt():
            op = ctx.AddInt().getText()
        elif ctx.SubFloat():
            op = ctx.SubFloat().getText()
        elif ctx.SubInt():
            op = ctx.SubInt().getText()
        return BinaryOp(op, self.visit(ctx.exp3()), self.visit(ctx.exp4()))
    
    def visitExp4(self, ctx:BKITParser.Exp4Context):
        if ctx.getChildCount() == 1:
            return self.visit(ctx.exp5())
        if ctx.MulFloat():
            op = ctx.MulFloat().getText()
        elif ctx.MulInt():
            op = ctx.MulInt().getText()
        elif ctx.Modulus():
            op = ctx.Modulus().getText()
        elif ctx.DivFloat():
            op = ctx.DivFloat().getText()
        elif ctx.DivInt():
            op = ctx.DivInt().getText()
        return BinaryOp(op , self.visit(ctx.exp4()), self.visit(ctx.exp5()))


    def visitExp5(self, ctx:BKITParser.Exp5Context):
        
        return self.visit(ctx.exp6()) if ctx.getChildCount()==1 else UnaryOp(ctx.Not().getText(), self.visit(ctx.exp5()))
        
    
    def visitExp6(self, ctx:BKITParser.Exp6Context):
        if ctx.getChildCount() == 1:
            return self.visit(ctx.exp7())
        op = ctx.SubInt().getText() if ctx.SubInt() else ctx.SubFloat().getText()
        return UnaryOp(op, self.visit(ctx.exp6()))
    
    def visitExp7(self, ctx:BKITParser.Exp7Context):
        return self.visit(ctx.exp8()) if ctx.exp8() else self.visit(ctx.indexVar())

    def visitExp8(self, ctx:BKITParser.Exp8Context):
        if ctx.funcCall():
            return self.visit(ctx.funcCall())
        elif ctx.INT():
            return IntLiteral(ctx.INT().getText())
        elif ctx.FLOAT():
            return  FloatLiteral(ctx.FLOAT().getText())
        elif ctx.BOOL():
            return  BooleanLiteral(ctx.BOOL().getText())
        elif ctx.ID():
            return Id(ctx.ID().getText())
        elif ctx.exp1():
            return self.visit(ctx.exp1())

    def visitIndexVar(self, ctx:BKITParser.IndexVarContext):
        arr = Id(ctx.ID().getText()) if ctx.ID() else self.visit(ctx.funcCall())
        idx = [self.visit(i) for i in ctx.exp3()]
        return ArrayCell(arr, idx)

    def visitArray(self, ctx:BKITParser.ArrayContext):
        listOfArrayLit = [self.visit(i) for i in ctx.arrayList()]
        return ArrayLiteral(listOfArrayLit)

    def visitArrayList(self, ctx:BKITParser.ArrayListContext):
        return self.visit(ctx.typeLit()) if ctx.typeLit() else self.visit(ctx.array())

    def visitTypeLit(self, ctx:BKITParser.TypeLitContext):
        if ctx.INT():
            return IntLiteral(ctx.INT().getText())
        elif ctx.FLOAT():
            return  FloatLiteral(ctx.FLOAT().getText())
        elif ctx.BOOL():
            return  BooleanLiteral(ctx.BOOL().getText())
        elif ctx.SUBSTRING():
            return  StringLiteral(ctx.SUBSTRING().getText())