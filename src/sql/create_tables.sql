-- TODO
  -- shouldn't avatar be fb pic?
  -- should be separating betting from user table
  
-- Users Table
CREATE TABLE Users (
  id INT NOT NULL UNIQUE AUTO_INCREMENT,
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
  requestingUserId INT NOT NULL,
  approvingUserId INT NOT NULL,
  requestStatus ENUM("pending", "approved") NOT NULL,
  FOREIGN KEY(requestingUserId) REFERENCES Users(id) ON DELETE CASCADE,
  FOREIGN KEY(approvingUserId) REFERENCES Users(id) ON DELETE CASCADE,
  PRIMARY KEY(id)
);

-- Teams Table
CREATE TABLE Teams (
  id INT NOT NULL UNIQUE AUTO_INCREMENT,
  name VARCHAR(20) NOT NULL UNIQUE, -- unique for football, only. Must change for other sports
  city VARCHAR(20) NOT NULL,
  cityAbbreviation VARCHAR(3),
  state VARCHAR(10) NOT NULL,
  PRIMARY KEY(id)
);

-- Season Table
CREATE TABLE Seasons (
  id INT NOT NULL UNIQUE AUTO_INCREMENT,
  teamId INT NOT NULL,
  wins INT NOT NULL,
  losses INT NOT NULL,
  ties INT NOT NULL,
  gamesPlayed INT NOT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY(teamId) REFERENCES Teams(id) ON DELETE CASCADE
);

-- Score Table
CREATE TABLE Games (
  id INT NOT NULL UNIQUE AUTO_INCREMENT,
  date DATETIME NOT NULL,
  homeTeamId INT NOT NULL,
  awayTeamId INT NOT NULL,
  homeTeamScore INT NOT NULL,
  awayTeamScore INT NOT NULL,
  period INT NOT NULL,
  status ENUM("scheduled", "completed", "in_progress", "cancelled") NOT NULL,
  gameTime VARCHAR(20) NOT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY(homeTeamId) REFERENCES Teams(id) ON DELETE CASCADE,
  FOREIGN KEY(awayTeamId) REFERENCES Teams(id) ON DELETE CASCADE
);

-- Bets Table
CREATE TABLE Bets (
  id INT NOT NULL UNIQUE AUTO_INCREMENT,
  gameId INT NOT NULL,
  teamId INT NOT NULL,
  bettingUserId INT NOT NULL,
  bettingUserHandicap FLOAT NOT NULL, 
  wager INT NOT NULL,
  cancellationPenalty INT NOT NULL,
  status ENUM("pending", "approved", "completed", "cancelled") NOT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY(gameId) REFERENCES Bets(id) ON DELETE CASCADE,
  FOREIGN KEY(teamId) REFERENCES Teams(id) ON DELETE CASCADE,
  FOREIGN KEY(bettingUserId) REFERENCES Users(id) ON DELETE CASCADE
);

-- User Bets
CREATE TABLE UserBets (
  id INT NOT NULL AUTO_INCREMENT,
  userId INT NOT NULL,
  betId INT NOT NULL,
  FOREIGN KEY(userId) REFERENCES Users(id) ON DELETE CASCADE,
  FOREIGN KEY(betId) REFERENCES Bets(id) ON DELETE CASCADE,
  PRIMARY KEY(id)
);
