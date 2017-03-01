 <div class="row">
      <div class="message-block">
      @if (Session::has('message'))
      
        <div class="alert alert-success">
        <strong>{{ Session::get('message') }}</strong> 
         </div>
          
        </p>
      </div>
      @endif
</div>
</div>
 