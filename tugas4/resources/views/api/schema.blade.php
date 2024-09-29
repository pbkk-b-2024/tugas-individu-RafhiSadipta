@extends('layouts.app')

@section('content')
<div class="card mt-3">
    <div id="swagger-ui"></div>
</div>

<!-- Include Swagger UI JS and CSS from CDN -->
<link href="https://cdn.jsdelivr.net/npm/swagger-ui-dist/swagger-ui.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/swagger-ui-dist/swagger-ui-bundle.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swagger-ui-dist/swagger-ui-standalone-preset.js"></script>

<script>
    window.onload = function() {
        // Initialize Swagger UI
        const ui = SwaggerUIBundle({
            url: "{{ asset('openapi.json') }}", // Ensure openapi.json is in the public folder
            dom_id: '#swagger-ui',
            presets: [
                SwaggerUIBundle.presets.apis,
                SwaggerUIStandalonePreset
            ],
            layout: "BaseLayout",  // Use BaseLayout for the appearance
            deepLinking: true,
            showExtensions: true,
            showCommonExtensions: true
        })
        window.ui = ui
    }
</script>
@endsection
