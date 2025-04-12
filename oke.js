async function fetchData() {
 var options = new RestClientOptions({
   MaxTimeout: -1,
 });
 var client = new RestClient(options);
 var request = new RestRequest("http://calapi.inadiutorium.cz/api/v0/en/calendars/general-en/today", Method.Get);
 var response = await client.ExecuteAsync(request);
 console.log(response.Content);
}

fetchData();