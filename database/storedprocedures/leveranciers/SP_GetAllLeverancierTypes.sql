USE voedselbank2;

DROP PROCEDURE IF EXISTS SP_GetAllLeverancierTypes;

DELIMITER $$
-- =============================================
-- Author:      Dylan
-- Create date: 21-01-2026
-- Description: Haalt alle unieke, actieve leveranciertypes op
-- =============================================
CREATE PROCEDURE SP_GetAllLeverancierTypes()
BEGIN
    SELECT DISTINCT LeverancierType
    FROM Leverancier
    WHERE IsActief = 1
    ORDER BY LeverancierType;
END$$

DELIMITER ;

-- Test call
CALL SP_GetAllLeverancierTypes();
