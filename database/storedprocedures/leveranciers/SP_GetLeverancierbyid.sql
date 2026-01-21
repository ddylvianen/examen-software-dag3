USE Voedselbank2;

DROP PROCEDURE IF EXISTS SP_Getleverancierbyid;
-- naam, soort allergie, barcode, houdbaarheidsdatum, leveranciernaam, leveranciernummer, leveranciertype
DELIMITER $$
-- =============================================
-- Author:      Dylan
-- Create date: 21-01-2026
-- Description: Haalt een specifieke leverancier op via ID
-- =============================================
CREATE PROCEDURE SP_Getleverancierbyid(
    IN p_leverancierid INT
)
BEGIN
    SELECT
        l.Naam AS LeverancierNaam,
        l.LeverancierNummer,
        l.LeverancierType
    FROM Leverancier l
    WHERE l.id = p_leverancierid;
END$$


CALL SP_Getleverancierbyid(1);
