<div style="padding: 20px; font-family: Arial;">
    <h1>Simple Avatar Test</h1>
    
    <h2>Test asset() function directly:</h2>
    <ul>
        <li>asset('storage/avatars/3_1768372925.png') = <br><code>{{ asset('storage/avatars/3_1768372925.png') }}</code></li>
        <li>URL accessible? <a href="{{ asset('storage/avatars/3_1768372925.png') }}" target="_blank">Click to test</a></li>
    </ul>
    
    <hr>
    
    @foreach($users as $user)
        <div style="border: 2px solid #333; padding: 15px; margin: 15px 0;">
            <h2>{{ $user->nama_lengkap }} (ID: {{ $user->id }})</h2>
            
            @php
                // Build path
                $path = '';
                if ($user->provider == null && $user->avatar) {
                    if (strpos($user->avatar, 'avatars/') === 0) {
                        $path = 'storage/' . $user->avatar;
                    } else {
                        $path = 'assets/images/user/' . $user->avatar;
                    }
                } else {
                    $path = 'assets/images/avatar-default.png';
                }
            @endphp
            
            <p><strong>Avatar field value:</strong> <code>{{ $user->avatar }}</code></p>
            <p><strong>Path variable:</strong> <code>{{ $path }}</code></p>
            <p><strong>asset() result:</strong> <code>{{ asset($path) }}</code></p>
            
            <p><strong>Image test:</strong></p>
            <img src="{{ asset($path) }}" alt="{{ $user->nama_lengkap }}" 
                 style="width: 120px; height: 120px; border: 2px solid red;">
        </div>
    @endforeach
</div>
