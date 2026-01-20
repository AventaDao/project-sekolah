<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Firebase Logging Test</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            padding: 40px;
            max-width: 600px;
            width: 100%;
        }
        
        h1 {
            color: #333;
            margin-bottom: 10px;
            text-align: center;
        }
        
        .subtitle {
            color: #666;
            text-align: center;
            margin-bottom: 30px;
            font-size: 14px;
        }
        
        .test-section {
            margin-bottom: 30px;
            padding-bottom: 30px;
            border-bottom: 1px solid #eee;
        }
        
        .test-section:last-child {
            border-bottom: none;
        }
        
        .test-title {
            color: #667eea;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .test-title::before {
            content: '';
            width: 4px;
            height: 20px;
            background: #667eea;
            border-radius: 2px;
        }
        
        .test-description {
            color: #666;
            font-size: 13px;
            margin-bottom: 12px;
            line-height: 1.5;
        }
        
        .button-group {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        
        button {
            flex: 1;
            min-width: 150px;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn-primary {
            background: #667eea;
            color: white;
        }
        
        .btn-primary:hover {
            background: #5568d3;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }
        
        .btn-success {
            background: #48bb78;
            color: white;
        }
        
        .btn-success:hover {
            background: #38a169;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(72, 187, 120, 0.3);
        }
        
        .btn-info {
            background: #4299e1;
            color: white;
        }
        
        .btn-info:hover {
            background: #3182ce;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(66, 153, 225, 0.3);
        }
        
        .response {
            margin-top: 15px;
            padding: 12px;
            border-radius: 6px;
            font-size: 13px;
            font-family: 'Courier New', monospace;
            display: none;
        }
        
        .response.show {
            display: block;
        }
        
        .response.success {
            background: #f0fdf4;
            border: 1px solid #86efac;
            color: #166534;
        }
        
        .response.error {
            background: #fef2f2;
            border: 1px solid #fca5a5;
            color: #991b1b;
        }
        
        .response.loading {
            background: #eff6ff;
            border: 1px solid #93c5fd;
            color: #1e40af;
        }
        
        .info-box {
            background: #f0f4ff;
            border-left: 4px solid #667eea;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 13px;
            color: #333;
            line-height: 1.6;
        }
        
        .info-box strong {
            color: #667eea;
        }
        
        .loading-spinner {
            display: inline-block;
            width: 14px;
            height: 14px;
            border: 2px solid #f3f3f3;
            border-top: 2px solid #667eea;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-right: 5px;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .status {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            margin-left: 10px;
        }
        
        .status.success {
            background: #dcfce7;
            color: #166534;
        }
        
        .status.error {
            background: #fee2e2;
            color: #991b1b;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔥 Firebase Logging Test</h1>
        <p class="subtitle">Test Firebase activity logging integration</p>
        
        <div class="info-box">
            <strong>ℹ️ Info:</strong> Click any button below to test Firebase logging. Check your Firebase Console → Firestore Database → <strong>activity_logs</strong> collection to see the logs.
        </div>
        
        <!-- Test 1: All Log Types -->
        <div class="test-section">
            <div class="test-title">Test 1: All Log Types</div>
            <p class="test-description">
                Send test logs for all activity types (document, form, approval, user, authentication, general)
            </p>
            <div class="button-group">
                <button class="btn-primary" onclick="testAllLogs()">
                    Send All Logs
                </button>
            </div>
            <div id="response-all" class="response"></div>
        </div>
        
        <!-- Test 2: Document Logging -->
        <div class="test-section">
            <div class="test-title">Test 2: Document & Form Logging</div>
            <p class="test-description">
                Test pengajuan surat creation logging (document + form types)
            </p>
            <div class="button-group">
                <button class="btn-success" onclick="testPengajuanLog(1)">
                    Test with ID 1
                </button>
                <button class="btn-success" onclick="testPengajuanLog(2)">
                    Test with ID 2
                </button>
            </div>
            <div id="response-pengajuan" class="response"></div>
        </div>
        
        <!-- Test 3: Approval Logging -->
        <div class="test-section">
            <div class="test-title">Test 3: Approval & User Logging</div>
            <p class="test-description">
                Test approval/status change logging (approval + user action types)
            </p>
            <div class="button-group">
                <button class="btn-info" onclick="testApprovalLog(1)">
                    Test with ID 1
                </button>
                <button class="btn-info" onclick="testApprovalLog(2)">
                    Test with ID 2
                </button>
            </div>
            <div id="response-approval" class="response"></div>
        </div>
        
        <!-- Info Section -->
        <div class="test-section" style="border-top: 1px solid #eee; padding-top: 20px;">
            <div class="test-title">📚 What Gets Logged?</div>
            <ul style="color: #666; font-size: 13px; line-height: 1.8; margin-left: 20px;">
                <li><strong>Document Log:</strong> Pengajuan surat creation events</li>
                <li><strong>Form Log:</strong> Form submission tracking</li>
                <li><strong>Approval Log:</strong> Status changes & approvals</li>
                <li><strong>User Log:</strong> Admin actions & user management</li>
                <li><strong>Auth Log:</strong> Login/logout/register events</li>
                <li><strong>General Log:</strong> System events & custom actions</li>
            </ul>
        </div>
    </div>

    <script>
        async function testAllLogs() {
            const responseDiv = document.getElementById('response-all');
            await sendRequest('/firebase-test/log', 'POST', responseDiv);
        }

        async function testPengajuanLog(id) {
            const responseDiv = document.getElementById('response-pengajuan');
            await sendRequest(`/firebase-test/log-pengajuan/${id}`, 'POST', responseDiv);
        }

        async function testApprovalLog(id) {
            const responseDiv = document.getElementById('response-approval');
            await sendRequest(`/firebase-test/log-approval/${id}`, 'POST', responseDiv);
        }

        async function sendRequest(url, method, responseDiv) {
            responseDiv.classList.add('show', 'loading');
            responseDiv.innerHTML = '<span class="loading-spinner"></span> Sending request...';

            try {
                // Get CSRF token from meta tag or generate one
                let csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
                
                if (!csrfToken) {
                    console.error('CSRF token not found!');
                }

                const response = await fetch(url, {
                    method: method,
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken || '',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                // Check if response is JSON
                const contentType = response.headers.get('content-type');
                if (!contentType || !contentType.includes('application/json')) {
                    const text = await response.text();
                    throw new Error(`Server returned HTML instead of JSON. Status: ${response.status}. Response: ${text.substring(0, 200)}`);
                }

                const data = await response.json();

                if (response.ok) {
                    responseDiv.classList.remove('loading', 'error');
                    responseDiv.classList.add('success');
                    responseDiv.innerHTML = `
                        <strong>✅ Success!</strong><br>
                        ${JSON.stringify(data, null, 2)}
                    `;
                } else {
                    responseDiv.classList.remove('loading', 'success');
                    responseDiv.classList.add('error');
                    responseDiv.innerHTML = `
                        <strong>❌ Error (${response.status}):</strong><br>
                        ${JSON.stringify(data, null, 2)}
                    `;
                }
            } catch (error) {
                responseDiv.classList.remove('loading', 'success');
                responseDiv.classList.add('error');
                responseDiv.innerHTML = `
                    <strong>❌ Error:</strong><br>
                    ${error.message}
                `;
            }
        }
    </script>

</body>
</html>
<?php /**PATH C:\Users\PC_\Documents\New folder\project-sekolah\resources\views/firebase-test.blade.php ENDPATH**/ ?>