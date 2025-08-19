-- Enable spatial extensions and create necessary functions for geolocation
-- This script runs automatically when the MySQL container starts for the first time

USE app;

-- Ensure spatial functions are available
-- MySQL 8.0 has spatial functions built-in, but we can add custom helper functions

-- Create a function to calculate distance between two points in kilometers
DELIMITER $$

CREATE FUNCTION DISTANCE_KM(lat1 DECIMAL(10,8), lng1 DECIMAL(11,8), lat2 DECIMAL(10,8), lng2 DECIMAL(11,8))
RETURNS DECIMAL(10,3)
READS SQL DATA
DETERMINISTIC
BEGIN
    DECLARE distance DECIMAL(10,3);
    SET distance = (
        6371 * ACOS(
            COS(RADIANS(lat1)) * 
            COS(RADIANS(lat2)) * 
            COS(RADIANS(lng2) - RADIANS(lng1)) + 
            SIN(RADIANS(lat1)) * 
            SIN(RADIANS(lat2))
        )
    );
    RETURN distance;
END$$

DELIMITER ;

-- Create indexes that will be useful for spatial queries
-- Note: Actual tables will be created by Doctrine migrations
-- These are just preparatory optimizations

-- Set MySQL to use spatial reference system for better performance
SET @srid = 4326; -- WGS84 coordinate system

-- Create a sample spatial index template (will be applied to actual tables later)
-- This is just documentation for the migration files

/*
Example spatial index creation for user location:
CREATE SPATIAL INDEX idx_user_location ON users (location);

Example distance query optimization:
SELECT id, ST_Distance_Sphere(location, ST_GeomFromText('POINT(lng lat)', 4326)) / 1000 AS distance_km
FROM users 
WHERE ST_Distance_Sphere(location, ST_GeomFromText('POINT(lng lat)', 4326)) <= radius_in_meters
ORDER BY distance_km;
*/