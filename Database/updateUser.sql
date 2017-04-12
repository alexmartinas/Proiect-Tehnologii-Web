create or replace PROCEDURE update_user(nume varchar2,prenume varchar2,usrn_vechi varchar2,usrn_nou varchar2,parola_veche varchar2,parola_noua varchar2,eml varchar2,mesaj out varchar2)  as
v_user_id users.id_user%type;
v_count integer;
passwd users.password%type;
BEGIN
  select password into passwd from users where password=parola_veche;
  if(parola_veche!=passwd)
    then
      mesaj:='Wrong password';
    else
     select count(username) into v_count from users where username=usrn_nou and username!=usrn_vechi;
     if(v_count!=0)
      then
        mesaj:='This user already exists.Please choose something else!';
     else
       select count(email) into v_count from users where email=eml and username!=usrn_vechi;
         if(v_count!=0)
           then
             mesaj:='Used email.Please choose something else!';
         else
          update users set username=usrn_nou,password=parola_noua,name=nume||' ' ||prenume,email=eml where username=usrn_vechi; 
          mesaj:= 'Account updated';
        end if;
    end if;
  end if;
END;