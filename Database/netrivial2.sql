CREATE OR REPLACE FUNCTION proportie
RETURN number AS
   nr_notificari_baieti INTEGER;
   nr_notificari_fete INTEGER;
   v_proportie number;
  BEGIN
    select count(id_child) into nr_notificari_baieti from notifications natural join children where gender='male';
    select count(id_child) into nr_notificari_fete from notifications natural join children  where gender='female';
    v_proportie := nr_notificari_baieti/nr_notificari_fete;
    return v_proportie;
END;
