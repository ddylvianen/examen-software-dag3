-- Stored Procedure: SP_Voedselpakket_GetForEdit
-- Doel: Data voor edit status pagina (Wireframe-04/05/06)
-- Gebruikte tabellen: Voedselpakket

DROP PROCEDURE IF EXISTS SP_Voedselpakket_GetForEdit;
DELIMITER $$
CREATE PROCEDURE SP_Voedselpakket_GetForEdit(IN pVoedselpakketId INT UNSIGNED)
BEGIN
    SELECT
        v.Id AS VoedselpakketId,
        v.GezinId,
        v.PakketNummer,
        v.Status,
        v.DatumUitgifte
    FROM Voedselpakket v
    WHERE v.Id = pVoedselpakketId
      AND v.IsActief = 1
    LIMIT 1;
END$$
DELIMITER ;

