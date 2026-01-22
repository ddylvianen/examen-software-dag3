USE Voedselbank2;

DROP PROCEDURE IF EXISTS SP_Getleveranciers;

DELIMITER $$

-- =============================================
-- Author:      Dylan
-- Create date: 21-01-2026
-- Description: Haalt leveranciers op, inclusief contactgegevens
--              Optioneel gefilterd op LeverancierType
-- =============================================
CREATE PROCEDURE SP_Getleveranciers(
    IN p_LeverancierType VARCHAR(50)
)
BEGIN
    SELECT
        l.Id,
        l.Naam,
        l.ContactPersoon,
        l.LeverancierNummer,
        l.LeverancierType,
        c.Email,
        c.Mobiel
    FROM Leverancier l
    JOIN ContactPerLeverancier cpl ON l.Id = cpl.LeverancierId AND cpl.IsActief = 1
    LEFT JOIN Contact c ON cpl.ContactId = c.Id AND c.IsActief = 1
    WHERE l.IsActief = 1
    AND (p_LeverancierType = '' OR l.LeverancierType = p_LeverancierType)
    ORDER BY l.Naam;
END$$

DELIMITER ;

-- Test calls
CALL SP_Getleveranciers('');
CALL SP_Getleveranciers('Donor');

