<!DOCTYPE html>
<html lang="en">
 
<head>        
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />    
    <!--[if gt IE 8]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />        
    <![endif]-->                
    <title>Admin | Panel</title>
    <link rel="icon" type="image/ico" href="favicon.ico"/>
    
    <link href="css/stylesheets.css" rel="stylesheet" type="text/css" />
    
    <!--[if lte IE 7]>
        <script type='text/javascript' src='js/other/lte-ie7.js'></script>
    <![endif]-->    
    
    <script type='text/javascript' src='js/jquery/jquery.min.js'></script>
    <script type='text/javascript' src='js/jquery/jquery-ui-1.10.3.custom.min.js'></script>
    <script type='text/javascript' src='js/jquery/jquery-migrate.min.js'></script>
    <script type='text/javascript' src='js/jquery/globalize.js'></script>
    
    <script type='text/javascript' src='js/bootstrap/bootstrap.min.js'></script>
    <script type='text/javascript' src='js/cookies/jquery.cookies.2.2.0.min.js'></script>
    
    <script type='text/javascript' src='js/scrollup/jquery.scrollUp.min.js'></script>
    
    <script type='text/javascript' src='js/plugins.js'></script>    
    <script type='text/javascript' src='js/actions.js'></script>
</head>
<body>        
    <div id="wrapper" class="screen_wide sidebar_off">       
        <div id="layout">
            <div id="content">                        
                <div class="wrap nm">            
                    
                    <div class="signin_block">
                        <div class="row">
                            <div class="alert alert-info">
                                <strong>Howdy!</strong> Please, don't tell anyone your password
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                            </div>
                            <div class="block">
                                <div class="head">
                                    <h2>Sign in</h2>                                    
                                    <ul class="buttons">                                        
                                        <li><a href="#" class="tip" title="Contact administrator"><i class="i-warning"></i></a></li>
                                        <li><a href="#" class="tip" title="Forget your password?"><i class="i-locked"></i></a></li>
                                    </ul>                                     
                                </div>
                                <form  method="POST" action="{{ route('login') }}">
                                    @csrf
                                <div class="content np">
                                    <div class="controls-row">
                                        <div class="col-md-3">Login:</div>
                                         <div class="col-md-9">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                                    </div>
                                    <div class="controls-row">
                                        <div class="col-md-3">Password:</div>
                                       <div class="col-md-9">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                                    </div>                                
                                </div>
                                <div class="footer">
                                    <div class="side fl">
                                        <label class="checkbox">
                                            <input type="checkbox" name="kmsi"/> Keep me signed in
                                        </label>
                                    </div>
                                    <div class="side fr">
                                        <button type="submit" class="btn btn-primary">Sign in</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>               
        
    </div>
    
</body>
 
</html>
