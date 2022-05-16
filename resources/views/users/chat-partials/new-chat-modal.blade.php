<!-- New Chat Modal -->
<div class="modal fade" id="chat_new_message_modal" tabindex="-1" role="dialog" aria-labelledby="message_modal" aria-hidden="true">
    <div class="container modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content container pr-4 pl-4" id="message_modal">
            <span class="mod-close" data-dismiss="modal" aria-hidden="true">
                <img src="{{asset('/assets/landing_page/icons/Close.svg', config()->get('app.https'))}}?v=2.3" alt="" class="w-100">
            </span>
            <div class="modal-body page-title">
                <h4 class="modal-header-title title mb-3">Nova Mensagem</h4>
                <h1 class="modal-header-title title m-0" style="font-size: 28px;">Para:</h1>
                <div class="login-form">
                    @if (session('login_error'))
                        <div class="alert alert-danger">
                            {{ session('login_error') }}
                        </div>
                    @endif
                    <form id="form_new_messages_to" action="">
                        @csrf
                        <div class="form-group">
                            <div class="select2_with_search">
                                <select name="select_users_for_new_chat_ids[]" id="select_users_for_new_chat" class="form-control" multiple style="border: none;">
                                    @foreach ($users_without_chats as $user)                                             
                                        <option value="{{ $user->id }}" data-image="{{ $user->avatar_url ? '/webapp-macau-storage/avatars/'.$user->id.'/'.$user->avatar_url : 'https://via.placeholder.com/500x500'}}">
                                            {{ $user->username }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group d-flex justify-content-center mb-4 mt-5">
                            <a href="#" class="btn search-btn comment_submit write_new_message_to" data-target="#chat_new_message_modal">
                                Escrever &nbsp; <img src="{{asset('/assets/backoffice_assets/icons/contact.svg', config()->get('app.https'))}}?v=2.3" alt="">
                            </a>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->
