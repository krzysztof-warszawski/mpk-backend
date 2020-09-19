DELIMITER $$

CREATE PROCEDURE CreateBuilding(
    address VARCHAR(255),
    name VARCHAR(255),
    owner VARCHAR(255)
)

BEGIN

    DECLARE last_id INT DEFAULT 0;

    START TRANSACTION;

    INSERT INTO mpkdb.building(address, name, owner)
    Values (address, name, owner);

    SET last_id = LAST_INSERT_ID();

    IF last_id > 0 THEN
        SELECT * FROM mpkdb.building
        WHERE building_id=last_id;

        COMMIT;
    ELSE
        ROLLBACK;
    END IF;
END$$

DELIMITER ;
