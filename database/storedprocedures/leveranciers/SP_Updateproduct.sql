USE voedselbank2;

DROP PROCEDURE IF EXISTS SP_Updateproduct;

DELIMITER $$

-- =============================================
-- Author:      Dylan
-- Create date: 21-01-2026
-- Description: Werkt de houdbaarheidsdatum van een product bij
--              Valideert of de nieuwe datum max 7 dagen in de toekomst is
-- Returns:     1 (succes) of -1 (validatiefout)
-- =============================================
CREATE PROCEDURE SP_Updateproduct(
    IN productid INT,
    IN houdbaardatum DATE
)
BEGIN
    DECLARE existingDate DATE;
    SELECT Houdbaarheidsdatum FROM Product WHERE id = productid INTO existingDate;

    -- mag niet meer dan 7 dagen in de toekomst liggen
    if (DATEDIFF(houdbaardatum, existingDate) > 7) then
        SELECT -1 AS Affected;
    else
        update Product
       set Houdbaarheidsdatum=houdbaardatum
        where id = productid;

        SELECT ROW_COUNT() AS Affected;
    end if;

END$$

DELIMITER ;


CALL SP_Updateproduct(1, '2026-02-28');
