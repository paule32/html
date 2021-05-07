cl.exe /D_USRDLL /D_WINDLL /EHsc /O2 /LIBPATH:"E:\Apache2.4\apache\lib" /I"E:\Apache2.4\apache\include" /STD:c14 mod_pascal.c /LINK /LD /OUT:"mod_pascal.dll" 
copy mod_pascal.dll mod_pascal.so
