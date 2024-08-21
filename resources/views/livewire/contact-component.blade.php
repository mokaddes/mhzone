<div>
    <section class="section contact">
        <div class="container">
            <div class="contact">
                <div class="contact_form" style="margin-top: 100px;">
                     <div class="row d-flex justify-content-center">
                         <div class="col-lg-8">
                             <div class="header_content mb-4">
                                 <h2>Contact Us</h2>
                                 <h5>How can we help?</h5>
                                 <p>Check out our <a href="#">help center</a> for quick solutions.</p>
                             </div>

                             <div class="form">
                                 <form action="{{route('frontend.contactForm')}}" method="post" enctype="multipart/form-data" >
                                     
                                     <div class="mb-3">
                                         <label class="form-label">Email Address</label>
                                         <input type="text" name="email" id="email" class="form-control" placeholder="email@example.com">
                                     </div>
                                     <div class="mb-3">
                                         <label class="form-label">Listing URL</label>
                                         <input type="text" name="listing_url" id="listing_url" class="form-control" placeholder="httpse://www.grailed.com/listing/my-listing-id">
                                     </div>
                                     <div class="mb-3">
                                         <label class="form-label">I need help with</label>
                                         <select name="help" id="help" class="form-control">
                                             {{-- @foreach ($contactHelps as $contactHelp)

                                             @endforeach --}}
                                         </select>
                                     </div>
                                     <div class="mb-3">
                                         <label class="form-label">Request Reason</label>
                                         <select name="reason" id="help" class="form-control">
                                             <option value="" class="d-none">Select a request category....</option>
                                             <option value="Something I sold">Something I sold</option>
                                             <option value="Something I purchased">Something I purchased</option>
                                             <option value="My account">My account</option>
                                             <option value="Something else">Something else</option>
                                         </select>
                                     </div>

                                     <div class="mb-3">
                                         <label class="form-label">Screenshot</label><br/>
                                         <label class="input_file form-label">
                                              <span id="upload_pic">Upload Photo</span>
                                              <input type="file" onchange="loadFile(event)" name="image" id="image" class="d-none">
                                         </label>
                                        <img id="preview" src="http://127.0.0.1:8000/frontend/images/footer-bg.webp" alt="image">
                                     </div>

                                     <div class="mb-3">
                                         <label class="form-label">Describe your issue in a few words</label>
                                         <textarea name="message" id="message" cols="30" rows="3" class="form-control" placeholder="If this is about an item you have purchased or sold, please include a link or screenshot to the listing."></textarea>
                                     </div>

                                     <button type="submit" class="btn btn-success">Send</button>

                                 </form>
                             </div>
                         </div>
                     </div>
                </div>

            </div>
        </div>
    </section>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script>
    // preview image
        var loadFile = function(event) {
            var image       = document.getElementById('preview');
            var upload_pic  = document.getElementById('upload_pic');
            image.src       = URL.createObjectURL(event.target.files[0]);
            upload_pic.innerHTML = 'Replace Photo';
        };
</script>



