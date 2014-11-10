-- Select most recent SeasonAdminInfo
SELECT * 
  FROM SeasonAdminInfo
  WHERE current_year =
    (SELECT MAX(current_year) FROM SeasonAdminInfo)
  ORDER BY current_week DESC
  LIMIT 1;

