-- wrk-test.lua
init = function(args)
    requests = 0
    responses = 0
end

request = function()
    requests = requests + 1
    local path = "/"
    local headers = {}
    headers["Content-Type"] = "application/x-www-form-urlencoded"
    
    return wrk.format("GET", path, headers)
end

response = function(status, headers, body)
    responses = responses + 1
end

done = function(summary, latency, requests)
    print("Requests: " .. summary.requests)
    print("Duration: " .. summary.duration .. "ms")
    print("Bytes: " .. summary.bytes)
    print("Requests/sec: " .. summary.requests/summary.duration*1000)
end
