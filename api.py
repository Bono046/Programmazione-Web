import requests

# make your request
RACE_LIST = False
RACE_ID = 1
WITH_DEVICES = False




url_base = 'http://localhost:8000/api/'
if RACE_LIST:
    url = f"{url_base}races/"
elif RACE_ID:
    url = f"{url_base}race/{RACE_ID}/"
    if WITH_DEVICES:
        url += "?withDevices=1"

print(url)
response = requests.get(url)

if response.status_code == 200:
    data = response.json()
    print(response)
    print(data)
else:
    print(f"Error: {response.status_code}")