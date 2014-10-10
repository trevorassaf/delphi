import urllib2
import json

api_key = "94134631-49C0-4079-A011-EC727A676638"

def print_greeting():
	print("=== TASTE THE NFL ===")

def get_week():
	while True:
		week = raw_input("What 2014 week (1-17)? ").strip()
		if is_valid_week(week):
			return week
		print("Bad.")

def is_valid_week(str):
    try:
    	week = int(str)
    	return week > 0 and week < 18
    except ValueError:
    	return False

def get_week_results():
	url = "http://api.nfldata.apiphany.com/trial/JSON/ScoresByWeek/2014REG/%s?key=%s" % (week, api_key)
	response = urllib2.urlopen(url)
	return response.read()

print_greeting()
week = get_week()
raw_json = get_week_results()
week_object = json.loads(raw_json);

for i in range(0, len(week_object)):
	wk = week_object[i];
	home_team = wk['HomeTeam']
	home_score = wk['HomeScore']
	away_team = wk['AwayTeam']
	away_score = wk['AwayScore']
	print("%s %s @ %s %s" % (home_team, home_score, away_team, away_score))
