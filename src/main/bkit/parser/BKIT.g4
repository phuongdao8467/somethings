grammar BKIT;
//1813611
@lexer::header {
1813611
from lexererr import *
}

@lexer::members {
def emit(self):
    tk = self.type
    result = super().emit()
    if tk == self.UNCLOSE_STRING:       
        raise UncloseString(result.text)
    elif tk == self.ILLEGAL_ESCAPE:
        raise IllegalEscape(result.text)
    elif tk == self.ERROR_CHAR:
        raise ErrorToken(result.text)
    elif tk == self.UNTERMINATED_COMMENT:
        raise UnterminatedComment()
    else:
        return result;
}

options{
	language=Python3;
}

program  : declList EOF;
//---variable declaration------------------
declList:
decl
| decl declList

;
decl:
var
|funcDec
;
var
	:Var COLON varList (CM varList)* SM
	;
varList
	:ID EQ (typeLit|array)
	|ID
	|ID (LSB INT RSB)+ EQ (typeLit|array)
	|
	;

//---Functioin declaration------------------
funcDec
	: Function COLON ID (Parameter COLON varList (CM varList)*)? Body COLON (var? statementList*) EndBody DOT
	;
//---Statement--------------------------------
statementList	
	: ifState
	| assignment
	| forState
	| whileState
	| doWhileState
	| breakState
	| continueState
	| callState
	| returnState
	;
assignment
	:(ID|indexVar) EQ exp1 SM
	;
ifState
	: If exp1 Then stmtBody (ElseIf exp1 Then stmtBody)* (Else stmtBody)? EndIf DOT
	;
stmtBody
	: var? statementList*
	;
forState
	: For LP (ID|indexVar) EQ exp1 (CM) exp1 (CM) exp3  RP Do stmtBody EndFor DOT
	;
// forAssignment
//     : (ID|indexVar) EQ exp1
//     ;
whileState
	: While exp1 Do stmtBody EndWhile DOT
	;
doWhileState
	: Do stmtBody While exp1 EndDo DOT
	;
breakState
	: Break SM
	;
continueState
	: Continue SM
	;
callState
	: funcCall SM
	;
returnState
	: Return exp1 SM
	;

funcCall
	:ID LP (exp1(CM exp1)*)? RP
	;
//---expression-------------------
exp1
	: exp2 Equals exp2
	| exp2 NEqualsInt exp2
	| exp2 LTInt exp2
	| exp2 LTEqualsInt exp2
	| exp2 GTInt exp2
	| exp2 GTEqualsInt exp2
	| exp2 NEqualsFloat exp2
	| exp2 LTFloat exp2
	| exp2 LTEqualsFloat exp2
	| exp2 GTFloat exp2
	| exp2 GTEqualsFloat exp2
	| exp2
	;
exp2
	: exp2 And exp3
	| exp2 Or exp3
	| exp3
	;
exp3
	: exp3 AddFloat exp4
	| exp3 AddInt exp4
	| exp3 SubFloat exp4
	| exp3 SubInt exp4
	| exp4
	;
exp4
	: exp4 MulFloat exp5
	| exp4 MulInt exp5
	| exp4 Modulus exp5
	| exp4 DivFloat exp5
	| exp4 DivInt exp5
	| exp5
	;
exp5
	: Not exp5
	| exp6
	;
exp6
	: SubInt exp6
	| SubFloat exp6
	| exp7
	;
exp7
	: indexVar
	| exp8
	;
exp8
	: funcCall
	| INT
	| FLOAT
	| BOOL
    | ID
	| LP exp1 RP
	;

indexVar
	: (ID|funcCall) (LSB exp3 RSB)+
	;
//----ARRAY------------------
array: 
LB arrayList (CM arrayList)* RB
;
arrayList:
typeLit
|array
;
typeLit: 
INT|FLOAT|SUBSTRING|BOOL
;
//---TOKEN----------------------

//--Identifiers + key words-----------


Body: 'Body' ;
Break: 'Break' ;
Continue: 'Continue' ;
Do: 'Do';
Else: 'Else' ;
ElseIf: 'ElseIf' ;
If: 'If';
EndIf: 'EndIf';
EndBody: 'EndBody';
Parameter: 'Parameter';
Return: 'Return';
Then: 'Then';
Var: 'Var';
While: 'While';
EndWhile: 'EndWhile';
EndDo: 'EndDo';
For: 'For';
EndFor: 'EndFor';
Function: 'Function';
//---white space-------------------------
WS: [\t\r\n ]+ -> skip;

//----ID--------
ID: [a-z][a-zA-Z0-9_]* ;
//True: 'True' ;
//False: 'False' ;
//---operator----------
AddInt: '+';
SubInt : '-';
AddFloat : '+.';
SubFloat : '-.';
MulInt: '*';
DivInt: '\\';
MulFloat: '*.';
DivFloat: '\\.';
Modulus  : '%';
Not: '!';
And: '&&';
Or: '||';
Equals: '==';
NEqualsInt: '!=';
NEqualsFloat: '=/=';
GTInt: '>';
LTInt: '<';
GTFloat: '>.';
LTFloat: '<.';
GTEqualsInt : '>=';
LTEqualsInt : '<=';
GTEqualsFloat : '>=.';
LTEqualsFloat : '<=.';

//---separators--------
SM: ';';
LB: '{';
RB: '}';
CM: ',';
EQ: '=';
LP: '(';
RP: ')';
COLON: ':';
DOT: '.';
LSB: '[';
RSB: ']';
//COLON_PLUS: ': ';
//----variable-------------------
INT 
: '0'
| ('0x' | '0X')[0-9A-F]+ 
| ('0o'|'0O')[0-7]+
| [1-9][0-9]* 
;

FLOAT: ('0' | [1-9][0-9]*)(DOT ( [0-9]+)?(('e'|'E')('+'|'-')[0-9]+)? )?(('e'|'E')('+'|'-')?[0-9]+)?;
//FLOAT: ('0'|[1-9]*)+DOT?([0-9]+)?('e'|'E')?((Add_int|Sub_int)?[0-9]+)? ;

BOOL: 'True' | 'False';

//-------STRING---------------
//fragment ESCAPE: '\\' [bfrnt'\\];

SUBSTRING
: '"'('\\'[tnfr'b\\]| '\'"' |(~[\\\t"\n\f\r\b']))* '"'
{
	self.text = self.text[1:-1]
}
; 

//TYPE: INT | FLOAT | BOOL | SUBSTRING;
//ARRAY_ID: ID('['INT']')+;
//---block comment -----------------
COMMENT: '**' .*? '**' -> skip ;

//---type and value-------------
//BOOL_TYPE: BOOL ('!' | '&&' | '||') BOOL;
//INT_TYPE: INT ( '+' | '*' | '-' | '\\' | '\\%' | '==' | '!=' | '<' | '>' | '<=' | '>=' ) INT;
//FLOAT_TYPE: FLOAT ( '+.' | '*.' | '-.' | '\\.' | '=/=' | '<.' | '>.' | '<=.' | '>=.' ) FLOAT;

ILLEGAL_ESCAPE
 	: '"' ( '\\' [bfrnt'\\] | ~[\n\r'"\\])* '\\'~[bfrnt'\\].*? '"'
	{
		for x in range(len(self.text)):
			if self.text[x] == '\\':
	  			if (self.text[x+1] == 'b') or (self.text[x+1] == 'f') or (self.text[x+1] == 'r') or (self.text[x+1] == '"n"'):
				    continue
	  			elif (self.text[x+1] == 'n') or (self.text[x+1] == 't') or (self.text[x+1] == '\'') or (self.text[x+1] == '\\'):
				    continue
	  			elif (x+1)==(len(self.text)) :
				    x=x-1
				    break
	  			else:
				    break									
			elif self.text[x] == "\'":
	  			x=x-1
	  			break
		raise IllegalEscape(self.text[1:x+2])
	}
   	;
UNCLOSE_STRING: '"'('\\'[tnfr'b\\]| '\'"' |(~[\\\t"\n\f\r\b']))*  { raise UncloseString(self.text[1:]) } ;
UNTERMINATED_COMMENT: '**'(.*?) { raise UnterminatedComment() };
ERROR_CHAR: . {raise ErrorToken(self.text[0:])};