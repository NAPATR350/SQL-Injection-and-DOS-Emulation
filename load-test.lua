wrk.method = "GET"
wrk.headers["Content-Type"] = "application/x-www-form-urlencoded"

request = function()
    local paths = {
        "/",
        "/products.php", 
        "/products.php?search=laptop",
        "/products.php?search=keyboard"
    }
    local random_path = paths[math.random(#paths)]
    return wrk.format(nil, random_path)
end

done = function(summary, latency, requests)
    print("=== LOAD TEST RESULTS ===")
    print(string.format("Total Requests: %d", summary.requests))
    print(string.format("Duration: %.2f seconds", summary.duration / 1000000))
    print(string.format("Requests/sec: %.2f", summary.requests / (summary.duration / 1000000)))
    print(string.format("Transfer/sec: %.2f MB", summary.bytes / (summary.duration / 1000000) / (1024*1024)))
    print(string.format("Latency:"))
    print(string.format("  - Average: %.2f ms", latency.mean / 1000))
    print(string.format("  - Max: %.2f ms", latency.max / 1000))
    print(string.format("  - Stdev: %.2f ms", latency.stdev / 1000))
end
