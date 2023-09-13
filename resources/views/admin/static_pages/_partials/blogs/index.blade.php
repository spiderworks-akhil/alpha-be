<div class="settings-item w-100 confirm-wrap">
    <hr/>
    <div class="row m-0">
        <div class="col-12">
            <form method="POST" action="{{ route('admin.static-pages.update-content') }}" class="p-t-15" id="faqForm" data-validate=true>
                                    @csrf
                                    <input type="hidden" name="id" value="{{encrypt($obj->id)}}">
                                    
                                        <div class="row">
                                            <div class="col-12">
                                                <p>Add extra content here. All fields should be an array of 'content', Eg. name="content['contact-heading']" </p>
                                            </div>
                                        </div>
                                        <hr/>
                                        <div class="row">
         
                                            <div class="col-sm-12 text-right">
                                                <button class="btn btn-primary btn-sm px-4">Save</button>
                                            </div>
                                        </div>
            </form>
        </div>
    </div>              
</div>
