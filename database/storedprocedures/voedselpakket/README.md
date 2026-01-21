# Voedselpakket stored procedures

Deze map bevat **alleen** de stored procedures voor de user stories **Voedselpakketten (read + update)**.

## Installeren in MySQL
Voer de `.sql` bestanden uit in dezelfde database als waar `database/createscript/script.sql` op is uitgevoerd.

Aanbevolen volgorde:
1. `SP_Voedselpakket_Eetwens_SelectAll.sql`
2. `SP_Voedselpakket_GezinnenOverzicht.sql`
3. `SP_Voedselpakket_GezinnenOverzicht_FilterEetwens.sql`
4. `SP_Voedselpakket_GezinDetail.sql`
5. `SP_Voedselpakket_PakkettenPerGezin.sql`
6. `SP_Voedselpakket_GetForEdit.sql`
7. `SP_Voedselpakket_UpdateStatus.sql`

## Belangrijk
- Deze procedures gebruiken **exact** de tabel-/kolomnamen uit `script.sql` (bijv. `Voedselpakket`, `GezinId`, `DatumUitgifte`, `Status`).
