import requests

# make your request
RACE_LIST = True
RACE_ID = 1
WITH_DEVICES = False


url_base = 'http://localhost:8000/api/'
url = ''
if RACE_LIST:
    url = f"{url_base}races/"
elif RACE_ID:
    url = f"{url_base}race/{RACE_ID}/"
    if WITH_DEVICES:
        url += "?withDevices=1"

#login
login_url = f"{url_base}login"
login_payload = {'email': 'admin@unibs.it', 'password': 'pass'}

login_response = requests.post(login_url, json=login_payload)

if login_response.status_code == 200:
    token = login_response.json().get("token")
    print("Login successful")

    headers = {
        "Authorization": f"Bearer {token}"
    }

    response = requests.get(url, headers=headers)
    print(f'request to: {url}')

    if response.status_code == 200:
        data = response.json()
        print(data)
    else:
        print(f"Error: {response.status_code}")

else:
    print(f"Login failed: {login_response.status_code}")



