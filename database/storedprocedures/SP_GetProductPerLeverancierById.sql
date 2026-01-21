USE voedselbank2;

DROP PROCEDURE IF EXISTS SP_GetProductPerLeverancierById;

DELIMITER $$
-- =============================================
-- Author:      Dylan
-- Create date: 21-01-2026
-- Description: Haalt alle producten op voor een specifieke leverancier
--              Formatteert datums naar dd-mm-yyyy
-- =============================================
CREATE PROCEDURE SP_GetProductPerLeverancierById(
    IN p_leverancierid INT
)
BEGIN
    SELECT
        p.Id,
        p.Naam,
        p.SoortAllergie,
        p.Barcode,
        DATE_FORMAT(p.Houdbaarheidsdatum, '%d-%m-%Y') as Houdbaarheidsdatum
    FROM Product p
    LEFT JOIN ProductPerLeverancier ppl ON p.Id = ppl.ProductId AND ppl.IsActief = 1
    WHERE ppl.LeverancierId = p_leverancierid;
END$$

DELIMITER ;

CALL SP_GetProductPerLeverancierById(1);
