USE voedselbank2;

DROP PROCEDURE IF EXISTS SP_GetProductById;

DELIMITER $$

-- =============================================
-- Author:      Dylan
-- Create date: 21-01-2026
-- Description: Haalt een specifiek product en gekoppelde leverancierID op via ProductID
-- =============================================
CREATE PROCEDURE SP_GetProductById(
    IN p_ProductId INT
)
BEGIN
    SELECT
        p.Id,
        p.Houdbaarheidsdatum,
        ppl.LeverancierId
    FROM Product p
    LEFT JOIN ProductPerLeverancier ppl ON p.Id = ppl.ProductId AND ppl.IsActief = 1
    WHERE p.Id = p_ProductId;
END$$

DELIMITER ;
