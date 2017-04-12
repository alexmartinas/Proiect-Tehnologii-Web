create or replace PROCEDURE delete_user(usrn varchar2,parola varchar2, mesaj out varchar2)  as
v_user_pass users.password%type;
v_count integer;
BEGIN
    select password into v_user_pass from users where username=usrn;
    if(v_user_pass!=parola)
      then
        mesaj:='Incorrect password';
    else
      delete from users where username=usrn;
      delete from monitoring where id_user=(select id_user from users where username=usrn);
       mesaj:= 'Your account has been deleted';
    end if;
END;