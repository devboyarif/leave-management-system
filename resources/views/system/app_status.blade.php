<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <div class="container pt-5">
        <div class="row">
           <div class="col-5">
            <form action="{{ route('update.system') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="file" class="form-control" name="update_zip">
                <button class="btn btn-primary mt-3">Update Now</button>
            </form>
           </div>
           <div class="col-lg-10 col-xxl-7 mx-auto">
               <div class="card">
                   <div class="card-header">
                       <h3 class="h6 mb-0">Server information</h3>
                   </div>
                   <div class="card-body">
                       <table class="table table-striped aiz-table">
                           <thead>
                               <tr>
                                   <th>Name</th>
                                   <th data-breakpoints="lg">Current Version</th>
                                   <th data-breakpoints="lg">Required Version</th>
                                   <th>Status</th>
                               </tr>
                           </thead>
                           <tbody>
                               <tr>
                                   <td>Php versions</td>
                                   <td>{{ phpversion() }}</td>
                                   <td>7.2 or 7.3</td>
                                   <td>
                                       @if (floatval(phpversion()) >= 7.2 && floatval(phpversion()) < 7.4)
                                       Done
                                       @else
                                       Not Done
                                       @endif
                                   </td>
                               </tr>
                               <tr>
                                   <td>MySQL</td>
                                   <td>
                                       @php
                                       $results = DB::select( DB::raw("select version()") );
                                       $mysql_version =  $results[0]->{'version()'};
                                       @endphp
                                       {{ $mysql_version }}
                                   </td>
                                   <td>5.6+</td>
                                   <td>
                                       @if ($mysql_version >= 5.6)
                                       Done
                                       @else
                                       Not Done
                                       @endif
                                   </td>
                               </tr>
                           </tbody>
                       </table>
                   </div>
               </div>
               <div class="card">
                   <div class="card-header">
                       <h3 class="h6 mb-0">php.ini Config</h3>
                   </div>
                   <div class="card-body">
                       <table class="table table-striped aiz-table">
                           <thead>
                               <tr>
                                   <th>Config Name</th>
                                   <th data-breakpoints="lg">Current</th>
                                   <th data-breakpoints="lg">Recommended</th>
                                   <th>Status</th>
                               </tr>
                           </thead>
                           <tbody>
                               <tr>
                                   <td>file_uploads</td>
                                   <td>
                                       @if(ini_get('file_uploads') == 1)
                                       On
                                       @else
                                       Off
                                       @endif
                                   </td>
                                   <td>On</td>
                                   <td>
                                       @if (ini_get('file_uploads') == 1)
                                       Done
                                       @else
                                       Not Done
                                       @endif
                                   </td>
                               </tr>
                               <tr>
                                   <td>max_file_uploads</td>
                                   <td>
                                       {{ ini_get('max_file_uploads') }}
                                   </td>
                                   <td>20+</td>
                                   <td>
                                       @if (ini_get('max_file_uploads') >= 20)
                                       Done
                                       @else
                                       Not Done
                                       @endif
                                   </td>
                               </tr>
                               <tr>
                                   <td>upload_max_filesize</td>
                                   <td>
                                       {{ ini_get('upload_max_filesize') }}
                                   </td>
                                   <td>128M+</td>
                                   <td>
                                       @if (str_replace(['M','G'],"", ini_get('upload_max_filesize')) >= 128)
                                       Done
                                       @else
                                       Not Done
                                       @endif
                                   </td>
                               </tr>
                               <tr>
                                   <td>post_max_size</td>
                                   <td>
                                       {{ ini_get('post_max_size') }}
                                   </td>
                                   <td>128M+</td>
                                   <td>
                                       @if (str_replace(['M','G'],"", ini_get('post_max_size')) >= 128)
                                       Done
                                       @else
                                       Not Done
                                       @endif
                                   </td>
                               </tr>
                               <tr>
                                   <td>allow_url_fopen</td>
                                   <td>
                                       @if(ini_get('allow_url_fopen') == 1)
                                       On
                                       @else
                                       Off
                                       @endif
                                   </td>
                                   <td>On</td>
                                   <td>
                                       @if (ini_get('allow_url_fopen') == 1)
                                       Done
                                       @else
                                       Not Done
                                       @endif
                                   </td>
                               </tr>
                               <tr>
                                   <td>max_execution_time</td>
                                   <td>
                                       @if(ini_get('max_execution_time') == '-1')
                                       Unlimited
                                       @else
                                       {{ ini_get('max_execution_time') }}
                                       @endif
                                   </td>
                                   <td>600+</td>
                                   <td>
                                       @if (ini_get('max_execution_time') == -1 || ini_get('max_execution_time') >= 600)
                                       Done
                                       @else
                                       Not Done
                                       @endif
                                   </td>
                               </tr>
                               <tr>
                                   <td>max_input_time</td>
                                   <td>
                                       @if(ini_get('max_input_time') == '-1')
                                       Unlimited
                                       @else
                                       {{ ini_get('max_input_time') }}
                                       @endif
                                   </td>
                                   <td>120+</td>
                                   <td>
                                       @if (ini_get('max_input_time') == -1 || ini_get('max_input_time') >= 120)
                                       Done
                                       @else
                                       Not Done
                                       @endif
                                   </td>
                               </tr>
                               <tr>
                                   <td>max_input_vars</td>
                                   <td>
                                       {{ ini_get('max_input_vars') }}
                                   </td>
                                   <td>1000+</td>
                                   <td>
                                       @if (ini_get('max_input_vars') >= 1000)
                                       Done
                                       @else
                                       Not Done
                                       @endif
                                   </td>
                               </tr>
                               <tr>
                                   <td>memory_limit</td>
                                   <td>
                                       @if(ini_get('memory_limit') == '-1')
                                       Unlimited
                                       @else
                                       {{ ini_get('memory_limit') }}
                                       @endif
                                   </td>
                                   <td>256M+</td>
                                   <td>
                                       @php
                                           $memory_limit = ini_get('memory_limit');
                                           if (preg_match('/^(\d+)(.)$/', $memory_limit, $matches)) {
                                               if ($matches[2] == 'G') {
                                                   $memory_limit = $matches[1] * 1024 * 1024 * 1024; // nnnM -> nnn GB
                                               } else if ($matches[2] == 'M') {
                                                   $memory_limit = $matches[1] * 1024 * 1024; // nnnM -> nnn MB
                                               } else if ($matches[2] == 'K') {
                                                   $memory_limit = $matches[1] * 1024; // nnnK -> nnn KB
                                               }
                                           }
                                       @endphp
                                       @if (ini_get('memory_limit') == -1 || $memory_limit >= (256 * 1024 * 1024))
                                       Done
                                       @else
                                       Not Done
                                       @endif
                                   </td>
                               </tr>
                           </tbody>
                       </table>
                   </div>
               </div>
               <div class="card">
                   <div class="card-header">
                       <h3 class="h6 mb-0">Extensions information</h3>
                   </div>
                   <div class="card-body">
                       <table class="table table-striped">
                           <thead>
                               <tr>
                                   <th>Extension Name</th>
                                   <th>Status</th>
                               </tr>
                           </thead>
                           @php
                           $loaded_extensions = get_loaded_extensions();
                           $required_extensions = ['bcmath', 'ctype', 'json', 'mbstring', 'zip', 'zlib', 'openssl', 'tokenizer', 'xml', 'dom',  'curl', 'fileinfo', 'gd', 'pdo_mysql']
                           @endphp
                           <tbody>
                               @foreach ($required_extensions as $extension)
                               <tr>
                                   <td>{{ $extension }}</td>
                                   <td>
                                       @if(in_array($extension, $loaded_extensions))
                                       Done
                                       @else
                                       Not Done
                                       @endif
                                   </td>
                               </tr>
                               @endforeach
                           </tbody>
                       </table>
                   </div>
               </div>
               <div class="card">
                   <div class="card-header">
                       <h3 class="h6 mb-0">Filesystem Permissions</h3>
                   </div>
                   <div class="card-body">
                       <table class="table table-striped">
                           <thead>
                               <tr>
                                   <th>File or Folder</th>
                                   <th>Status</th>
                               </tr>
                           </thead>
                           @php
                           $required_paths = ['.env', 'public', 'app/Providers', 'app/Http/Controllers', 'storage', 'resources/views','resources/lang']
                           @endphp
                           <tbody>
                               @foreach ($required_paths as $path)
                               <tr>
                                   <td>{{ $path }}</td>
                                   <td>
                                       @if(is_writable(base_path($path)))
                                       Done
                                       @else
                                       Not Done
                                       @endif
                                   </td>
                               </tr>
                               @endforeach
                           </tbody>
                       </table>
                   </div>
               </div>
           </div>
        </div>
    </div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
