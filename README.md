# InlineCssProvider

### Note: due to the (personal) need to be bolt.cm compliant; silex2 is not supported!!!

InlineCssProvider is a silex compliant serviceprovider of the CssToInlineStyles class by Tijs Verkoyen (https://github.com/tijsverkoyen/CssToInlineStyles).

Additional feature(s) are:
 * Direct rendering from twig.
 
 
## Usage
 - Base service: 'inlinecss.inlinecss'
 - Render service: 'inlinecss.render'
 
 The base service is a simple wrapper, the renderservice resolves a twig template first (optional)
 
 ## sample
 <code>
   $app->register(new InlineCssProvider(__DIR__.'/Resources/views/mails/css/main.css')); <br>
   ...
   ...
   ...
   <br>
   
     $email = new \Swift_Message(
          "Import failed on when processing the importfile",
          $app['inlinecss.render]->renderAndInlineTemplate('mails/failed_import.twig')
          , 'text/html');
   
   
 </code>
 