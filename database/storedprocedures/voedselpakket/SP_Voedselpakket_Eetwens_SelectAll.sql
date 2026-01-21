-- Stored Procedure: SP_Voedselpakket_Eetwens_SelectAll
-- Doel: dropdown values voor eetwensen (Wireframe: Selecteer Eetwens)
-- Alignt met: database/createscript/script.sql (tabel: Eetwens)

DROP PROCEDURE IF EXISTS SP_Voedselpakket_Eetwens_SelectAll;
DELIMITER $$
CREATE PROCEDURE SP_Voedselpakket_Eetwens_SelectAll()
BEGIN
    SELECT
        e.Id,
        e.Naam
    FROM Eetwens e
    WHERE e.IsActief = 1
    ORDER BY e.Id DESC;
END$$
DELIMITER ;

