   <div class="modal fade" id="userDetailsModal" tabindex="-1" aria-labelledby="userDetailsModalLabel" aria-hidden="true">
       <div class="modal-dialog modal-lg">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="userDetailsModalLabel">بيانات المستخدم</h5>
                   <button type="button" class="btn btn-icon btn-sm btn-active-light-primary ms-2"
                       data-bs-dismiss="modal" aria-label="Close">
                       <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                   </button>
               </div>
               <form id="userDetails-form" name="userDetails-form" method="POST" action="">
                   @csrf
                   <div class="modal-body">

                       <input type="hidden" id="user_detail_user_id" name="user_id">

                       <div class="row mb-3">
                           <div class="col-md-3 text-center">
                               <div class="circle mx-auto mb-2" style="width:120px;height:120px;">
                                   <img id="user_identity_image" class="user_identity_image show-photo-modal" src="" alt="صورة الهوية"
                                       style="object-fit:cover;width:100%;height:100%;">
                               </div>
                           </div>
                           <div class="col-md-9">
                               <div class="row">
                                   <div class="col-md-6 mb-2">
                                       <strong>الاسم الأول:</strong>
                                       <span id="user_first_name"></span>
                                   </div>
                                   <div class="col-md-6 mb-2">
                                       <strong>الاسم الثاني:</strong>
                                       <span id="user_second_name"></span>
                                   </div>
                                   <div class="col-md-6 mb-2">
                                       <strong>الاسم الثالث:</strong>
                                       <span id="user_third_name"></span>
                                   </div>
                                   <div class="col-md-6 mb-2">
                                       <strong>اسم العائلة:</strong>
                                       <span id="user_last_name"></span>
                                   </div>
                                   <div class="col-md-6 mb-2">
                                       <strong>تاريخ الميلاد:</strong>
                                       <span id="user_birth_date"></span>
                                   </div>
                                   <div class="col-md-6 mb-2">
                                       <strong>:رقم الهوية</strong>
                                       <span id="user_id_number"></span>
                                   </div>
                                   <div class="col-md-6 mb-2">
                                       <strong>حالة التحقق:</strong>
                                       <span id="user_verification_status"></span>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="row mb-3">
                           <div class="col-md-12 mb-2">
                               <label for="user_request_status"><strong>حالة الطلب:</strong></label>
                               <select id="user_request_status" name="is_verification" class="form-control"
                                   style="width: 100%">
                                   <option value="">اختر</option>

                                   <option value="3">مكتمل</option>
                               </select>
                           </div>
                       </div>
                   </div>
                   <div class="modal-footer">
                       <button type="submit" id="send_form" class="btn btn-primary">
                           <i class="fa fa-paper-plane hiden_icon" aria-hidden="true"></i>
                           <span id="spinner" style="display: none;">
                               <i class="fa fa-spinner fa-spin" style="font-size: 16px;"></i>
                           </span>
                           {{ __('label.submit') }}
                       </button>
                       <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                           <i class="fa fa-window-close" aria-hidden="true"></i>
                           {{ __('label.cancel') }}
                       </button>
                   </div>
               </form>
           </div>
       </div>
   </div>
