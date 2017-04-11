create or replace package login_pachet AS 
    FUNCTION LOG_IN(usrn varchar2 ,parola varchar2) return VARCHAR2;
    PROCEDURE inregistrare(nume varchar2,prenume varchar2,usrn varchar2,parola varchar2,eml varchar2,mesaj out varchar2);
END login_pachet;

/

create or replace package body login_pachet AS   
  FUNCTION LOG_IN(usrn varchar2 ,parola varchar2)
  RETURN varchar2 AS
  v_username varchar2(40);
  v_password varchar2(40);
  v_count integer:=0;
  BEGIN
    select count(users.username) into v_count from users where users.username=usrn;
    if(v_count!=1)
      then
        return 'Utilizator inexistent ';
      else
        select users.password into v_password from users where users.username=usrn;
        if(v_password!=parola)
            then
              return 'Parola gresita';
        end if;
    end if;
  return 'Logare cu succes';
  END LOG_IN;
  
  PROCEDURE inregistrare(nume varchar2,prenume varchar2,usrn varchar2,parola varchar2,eml varchar2,mesaj out varchar2) as
  v_user_id users.id_user%type;
  v_count integer;
  BEGIN
      select count(email) into v_count from users where email=eml;
      if(v_count!=0)
        then
          mesaj:='Email folosit';
      else
      select max(id_user) into v_user_id from users;
      insert into users values(v_user_id+1,usrn,parola,nume || ' ' || prenume,eml,0);
      mesaj:='Inregistrare efectuata';
      end if;
  END inregistrare;

  
END login_pachet;