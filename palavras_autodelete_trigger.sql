create or replace function palavras_autodelete_trigger() returns trigger as 
$$
declare
ids integer[];
i integer;
begin
	ids = array(select id from palavraschaves  where id not in (select palavraschave_id from docentes_palavras) and id not in (select palavraschave_id from empregadores_palavras) and id not in (select palavraschave_id from trabalhadores_palavras));
	foreach i in array ids loop
	delete from palavraschaves where id = i;
	end loop;
end;
$$
language 'plpgsql';

create trigger palavras_autodelete_trigger after delete on docentes_palavras 
for each statement execute procedure palavras_autodelete_trigger();
