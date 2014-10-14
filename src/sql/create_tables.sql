-- TODO
  -- shouldn't avatar be fb pic?
  -- should be separating betting from user table
  
-- Users Table
CREATE TABLE Users (
  id INT NOT NULL UNIQUE AUTO_INCREMENT,
  created_time DATETIME NOT NULL,
  last_updated_time DATETIME NOT NULL,
  fbId INT NOT NULL UNIQUE,
  username VARCHAR(20) NOT NULL UNIQUE,
  firstName VARCHAR(20) NOT NULL,
  lastName VARCHAR(20) NOT NULL,
  birthdate DATE NOT NULL,
  sex ENUM('male', 'gender', 'unspecified') NOT NULL,
  balance INT NOT NULL,
  isAdmin TINYINT(1) NOT NULL,
  PRIMARY KEY(id)
);

-- Friends Table
CREATE TABLE Friends (
  id INT NOT NULL UNIQUE AUTO_INCREMENT,
  created_time DATETIME NOT NULL,
  last_updated_time DATETIME NOT NULL,
  requestingUserId INT NOT NULL,
  approvingUserId INT NOT NULL,
  requestStatus ENUM("pending", "approved") NOT NULL,
  PRIMARY KEY(id)
);

-- Teams Table
CREATE TABLE Teams (
  id INT NOT NULL UNIQUE AUTO_INCREMENT,
  created_time DATETIME NOT NULL,
  last_updated_time DATETIME NOT NULL,
  name VARCHAR(20) NOT NULL UNIQUE, -- unique for football, only. Must change for other sports
  full_name VARCHAR(40) NOT NULL UNIQUE,
  city VARCHAR(20) NOT NULL,
  team_key VARCHAR(3) NOT NULL UNIQUE,
  division VARCHAR(20) NOT NULL,
  conference VARCHAR(20) NOT NULL,
  season_key VARCHAR(20) NOT NULL,
  PRIMARY KEY(id)
);

-- Season Table
CREATE TABLE Seasons (
  id INT NOT NULL UNIQUE AUTO_INCREMENT,
  created_time DATETIME NOT NULL,
  last_updated_time DATETIME NOT NULL,
  teamId INT NOT NULL,
  wins INT NOT NULL,
  losses INT NOT NULL,
  ties INT NOT NULL,
  gamesPlayed INT NOT NULL,
  PRIMARY KEY(id)
);

-- Score Table
CREATE TABLE Games (
  id INT NOT NULL UNIQUE AUTO_INCREMENT,
  created_time DATETIME NOT NULL,
  last_updated_time DATETIME NOT NULL,
  date DATETIME NOT NULL,
  homeTeamKey VARCHAR(3) NOT NULL,
  awayTeamKey VARCHAR(3) NOT NULL,
  homeTeamScore INT NOT NULL,
  awayTeamScore INT NOT NULL,
  period INT NOT NULL,
  status ENUM("scheduled", "completed", "in_progress", "cancelled", "rescheduled") NOT NULL,
  gameTime VARCHAR(20) NOT NULL,
  seasonKey VARCHAR(10) NOT NULL,
  PRIMARY KEY(id)
);

-- Bets Table
CREATE TABLE Bets (
  id INT NOT NULL UNIQUE AUTO_INCREMENT,
  created_time DATETIME NOT NULL,
  last_updated_time DATETIME NOT NULL,
  gameId INT NOT NULL,
  teamId INT NOT NULL,
  bettingUserId INT NOT NULL,
  bettingUserHandicap FLOAT NOT NULL, 
  wager INT NOT NULL,
  cancellationPenalty INT NOT NULL,
  status ENUM("pending", "approved", "completed", "cancelled") NOT NULL,
  PRIMARY KEY(id)
);

-- User Bets
CREATE TABLE UserBets (
  id INT NOT NULL AUTO_INCREMENT,
  created_time DATETIME NOT NULL,
  last_updated_time DATETIME NOT NULL,
  userId INT NOT NULL,
  betId INT NOT NULL,
  PRIMARY KEY(id)
);

-- Administrative Information about Seasons
CREATE TABLE SeasonAdminInfo (
  id INT NOT NULL AUTO_INCREMENT,
  created_time DATETIME NOT NULL,
  last_updated_time DATETIME NOT NULL,
  PRIMARY KEY(id),
  current_week INT NOT NULL,
  current_year INT NOT NULL,
  season_key VARCHAR(10) NOT NULL
);
