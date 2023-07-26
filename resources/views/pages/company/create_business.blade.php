@extends('layouts.user_type.auth')
@section('content')

    {{-- @include('libraries.style') --}}
    @include('libraries.script')
    <style>
        /* Style the form */
        #regForm {
            background-color: #ffffff;
            margin: 100px auto;
            padding: 40px;
            width: 70%;
            min-width: 300px;
        }

        /* Style the input fields */
        input {
            padding: 10px;
            width: 100%;
            font-size: 17px;
            font-family: Raleway;
            border: 1px solid #aaaaaa;
        }

        /* Mark input boxes that gets an error on validation: */
        input.invalid {
            background-color: #ffdddd;
        }

        /* Hide all steps by default: */
        .tab {
            display: none;
        }

        /* Make circles that indicate the steps of the form: */
        .step {
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbbbbb;
            border: none;
            border-radius: 50%;
            display: inline-block;
            opacity: 0.5;
        }

        /* Mark the active step: */
        .step.active {
            opacity: 1;
        }

        /* Mark the steps that are finished and valid: */
        .step.finish {
            background-color: #04AA6D;
        }

        .page-title{
            font-size: 6vh;
        color: #8588e7;
        padding-top: 3vh;
        padding-left: 60vh;
        }
        .page-title2{
            font-size: 3vh;
        color: #5dbedc;
        padding-top: 4vh;
        }
        .para{
            font-size: 2vh;
        color: #cc1023;
        padding-left: 1cm;
        }
    </style>

        {{-- <a class="navbar-brand" href="{{route('companylist')}}">Company List</a> --}}
        <p>Create Buisiness Plan for :{{$company->name}}</p>

        {{-- <h1 class="page-title">Create Buisiness Plan</h1> --}}

            <div class="container">
        
                <div class="tab">
                    <div class="input-group w-60">
                        <h4 class="page-title2">1. Executive Summary</h4>
                    </div><br>
                    
                    <div class="input-group w-60">
                        <h6>Company History:</h6>
                    </div>
                    <div class="input-group w-80">
                        <input type="text" name="history" id="history" class="form-control" placeholder="The Company History and Leadership Model">
                    </div><br>
                    <div class="input-group w-60">
                        <h6>Overview:</h6>
                    </div>
                    <div class="input-group w-80">
                        <input type="text" name="over_view" id="over_view" class="form-control" placeholder="An Overview of Competitive Advantage(s)">
                    </div><br>
                    <div class="input-group w-60">
                        <h6>Financial Projections:</h6>
                    </div>
                    <div class="input-group w-80">
                        <input type="text" name="financial_project" id="financial_project" class="form-control" placeholder="Financial projection">
                    </div><br>
                    <div class="input-group w-60">
                        <h6>Investors:</h6>
                    </div>
                    <div class="input-group w-80">
                        <input type="text" name="investors" id="investors" class="form-control" placeholder="investors">
                    </div><br>
                    <div id="summary_form">
                        <div class="btn-group">
                            <input type="button" onclick="save_summary()" value="Save executive summary" class="btn btn-primary">
                        </div>  
                    </div>                   
                </div>

                <div class="tab">
                    <div class="input-group w-60">
                        <h4 class="page-title2">2. Prepared By</h4>
                    </div><br>
                    
                    <div class="input-group w-80">
                        <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                    </div><br>
                    <div class="input-group w-40">
                        <input type="text" name="role" id="role" class="form-control" placeholder="Role">
                    </div><br>
                    <div class="btn-group">
                        <input type="button" onclick="save_prepared_by()" value="Save Prepared by details" class="btn btn-primary">
                    </div>    
                </div>
                
                <div class="tab">
                    <div class="input-group w-60">
                        <h4 class="page-title2">3 .Competitors</h4>
                    </div><br>
                        @csrf
                        <div class="input-group w-60">
                            <h6>Competitor Name:</h6>
                        </div>
                        <div class="input-group w-80">
                            <input type="text" name="competitor_name" id="competitor_name" class="form-control" placeholder="competitor name">
                        </div><br>
                        <div class="input-group w-60">
                            <h6>Competitor Strength:</h6>
                        </div>
                        <div class="input-group w-80">
                            <input type="text" name="competitor_strength" id="competitor_strength" class="form-control" placeholder="What are your company’s assets that this competitor does not have?">
                        </div><br>
                        <div class="input-group w-60">
                            <h6>Competitor Weaknesses:</h6>
                        </div>
                        <div class="input-group w-80">
                            <input type="text" name="competitor_weak" id="competitor_weak" class="form-control" placeholder="In what areas or attributes do your competitors outperform you?">
                        </div><br>
                        <div class="input-group w-60">
                            <h6>Counterpoint/s:</h6>
                        </div>
                        <div class="input-group w-80">
                            <input type="text" name="counterpoint" id="counterpoint" class="form-control" placeholder="If a comparative weakness is mentioned in sales negotiations, which counterpoints can be used to address those weaknesses">
                        </div><br>
                        <div class="btn-group">
                            <input type="button" onclick="save_competitor()" value="save competitor details" class="btn btn-primary">
                        </div>      
                </div>
                
                <form action={{route('storeBusinessDetails')}} method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="container">
                    
                        <div class="tab">
                            <div class="input-group w-60">
                                <input type="hidden" name="company_id" id="company_id" class="form-control" value="{{$company->id}}">
                            </div><br>
                            <div class="input-group w-60">
                                <h4 class="page-title2">4. Company & Business Description</h4>
                            </div><br>
                            <div class="input-group w-60">
                                <h6>Company Purpose:</h6>
                            </div>
                            <div class="input-group w-80">
                                <textarea class="form-control" name="purpose" rows="3" placeholder="Provide a 1-2 paragraph description of your business, specifically highlighting what types of products/services you will provide, who your target market is, and why you think you’ll succeed with your current business plan"></textarea>    
                            </div><br>
                            <div class="input-group w-60">
                                <h6>Core Values:</h6>
                            </div>
                            <div class="input-group w-80">
                                <textarea class="form-control" name="core_val" rows="3" placeholder="Outline your company’s core values and why they were chosen"></textarea>    
                            </div><br>
                            <div class="input-group w-60">
                                <h6>Team & Org Structure:</h6>
                            </div>
                            <div class="input-group w-80">
                                <textarea class="form-control" name="team_structure" rows="3" placeholder="Provide an overview of your company. Who are the employees in key leadership roles, and what experience will they bring? How will your organization be structured?"></textarea>    
                            </div><br>                  
                        </div>
        
                        <div class="tab">
                            <div class="input-group w-60">
                                <h4 class="page-title2">5. Products and Services Line</h4>
                            </div><br>
                            <div class="input-group w-60">
                                <h6>Product Offering(s):</h6>
                            </div>
                            <div class="input-group w-80">
                                <textarea class="form-control" name="product_offer" rows="3" placeholder="Describe your product line in more detail, if applicable. List each product and its functionality"></textarea>    
                            </div><br>
                            <div class="input-group w-60">
                                <h6>Service Offerings:</h6>
                            </div>
                            <div class="input-group w-80">
                                <textarea class="form-control" name="service_offer" rows="3" placeholder="Describe your service line in more detail, if applicable. List each service and why you’re offering it"></textarea>    
                            </div><br>
                            <div class="input-group w-60">
                                <h6>Pricing Model:</h6>
                            </div>
                            <div class="input-group w-80">
                                <textarea class="form-control" name="pricing_model" rows="3" placeholder="What will you charge for each of your products and services? What will your markups be and why? (If you need help determining what your pricing model should be, try using our Sales Pricing Calculator"></textarea>    
                            </div><br>                  
                        </div>
        
                        <div class="tab">
                            <div class="input-group w-60">
                                <h4 class="page-title2">6. Market Analysis</h4>
                            </div><br>
                            <div class="input-group w-60">
                                <h6>Target Market:</h6>
                            </div>
                            <div class="input-group w-80">
                                <textarea class="form-control" name="target_market" rows="3" placeholder="Outline the market you’re targeting and why you’re doing so. Highlight the demographics, psychographics, and size of your total addressable market"></textarea>    
                            </div><br>
                            <div class="input-group w-60">
                                <h6>Buyer Personas:</h6>
                            </div>
                            <div class="input-group w-80">
                                <textarea class="form-control" name="buyer_pearsona" rows="3" placeholder="Who are you targeting? Buyer personas are semi-fictional representation of your ideal customer based on market research and real data about your existing customers. Outline these ideal customer personas here, and if you’re creating these personas from scratch, try using this free Buyer Persona Generator"></textarea>    
                            </div><br>
                            <div class="input-group w-60">
                                <h6>Location Analysis:</h6>
                            </div>
                            <div class="input-group w-80">
                                <textarea class="form-control" name="location_analysis" rows="3" placeholder="Explain why you’ve chosen your (proposed) location and what benefits you expect to see from it"></textarea>    
                            </div><br>                  
                        </div>
        
                        <div class="tab">
                            <div class="input-group w-60">
                                <h4 class="page-title2">7. Marketing Plan</h4>
                            </div><br>
                            <div class="input-group w-60">
                                <h6>Positioning Strategy:</h6>
                            </div>
                            <div class="input-group w-80">
                                <textarea class="form-control" name="position" rows="3" placeholder="Why are potential buyers going to be interested in your product? How will you address your buyer persona’s biggest challenges and goals? How will you use a website to your advantage?]"></textarea>    
                            </div><br>
                            <div class="input-group w-60">
                                <h6>Acquisition Channels :</h6>
                            </div>
                            <div class="input-group w-80">
                                <textarea class="form-control" name="acquisition" rows="3" placeholder="What are your main customer acquisition channels (e.g., search engine marketing, event marketing, blogging, co-marketing, paid, etc.) and what do you plan to prioritize this year?]"></textarea>    
                            </div><br>
                            <div class="input-group w-60">
                                <h6>Tools and Technology:</h6>
                            </div>
                            <div class="input-group w-80">
                                <textarea class="form-control" name="marketing_tools" rows="3" placeholder="What systems will you equip your marketing team with? Will you use a CMS, marketing automation software, or blogging software? If so, list it here"></textarea>    
                            </div><br>                  
                        </div>
        
                        <div class="tab">
                            <div class="input-group w-60">
                                <h4 class="page-title2">8. Sales Plan</h4>
                            </div><br>
                            <div class="input-group w-60">
                                <h6>Sales Methodology:</h6>
                            </div>
                            <div class="input-group w-80">
                                <textarea class="form-control" name="sales_meth" rows="3" placeholder="[How will you reach and engage with new leads? Are you pursuing an inbound or outbound sales strategy? Why does your prospecting strategy make sense for your business?]"></textarea>    
                            </div><br>
                            <div class="input-group w-60">
                                <h6>Sales Organization Structure:</h6>
                            </div>
                            <div class="input-group w-80">
                                <textarea class="form-control" name="sales_structure" rows="3" placeholder="Who will be in charge of selling your products and/or services? How will sales and marketing work together? How will the breakdown of roles look?]"></textarea>    
                            </div><br>
                            <div class="input-group w-60">
                                <h6>Sales Channels:</h6>
                            </div>
                            <div class="input-group w-80">
                                <textarea class="form-control" name="sales_channel" rows="3" placeholder="What will you utilize to sell your products? Will you sell online, in stores, or through sales reps? Are you going to sell at your own store or distribute to other stores?]"></textarea>    
                            </div><br>
                            <div class="input-group w-60">
                                <h6>Tools and Technology:</h6>
                            </div>
                            <div class="input-group w-80">
                                <textarea class="form-control" name="sales_tech" rows="3" placeholder="Describe the sales tools you will utilize – such as live chat, website and ecommerce sales integrations, your CRM software, and call software – and how they will help you hit your goal.]"></textarea>    
                            </div><br>                    
                        </div>
        
                        <div class="tab">
                            <div class="input-group w-60">
                                <h4 class="page-title2">9. Legal Notes</h4>
                            </div><br>
                            <div class="input-group w-60">
                                <h6>Legal Structure:</h6>
                            </div>
                            <div class="input-group w-80">
                                <textarea class="form-control" name="leagal_structure" rows="5" placeholder="What type of legal structure will your business be?]"></textarea>    
                            </div><br>
                            <div class="input-group w-60">
                                <h6>Legal Considerations:</h6>
                            </div>
                            <div class="input-group w-80">
                                <textarea class="form-control" name="legal_consideration" rows="5" placeholder="What legal considerations does your business need to keep in mind for its core operating procedures? List all government registrations, permits, health codes, insurance requirements, and zoning laws you need to address and how you have addressed/will address them"></textarea>    
                            </div><br>                  
                        </div>
        
                        <div class="tab">
                            <div class="input-group w-60">
                                <h4 class="page-title2">10. Financial Considerations</h4>
                            </div><br>
                            <div class="input-group w-60">
                                <h6>Startup Costs:</h6>
                            </div>
                            <div class="input-group w-80">
                                <textarea class="form-control" name="startup_cost" rows="3" placeholder="Outline each of your startup costs as a line item, followed by a total cost. You may also want to provide a more detailed list of costs – including vendors and payment dates – in the appendix"></textarea>    
                            </div><br>
                            <div class="input-group w-60">
                                <h6>Sales Forecasts:</h6>
                            </div>
                            <div class="input-group w-80">
                                <textarea class="form-control" name="sales_forcast" rows="3" placeholder="Provide your sales forecasts for the next several quarters or years. You may want to summarize the forecasts and point to a bottom-line metric, then point to a more detailed spreadsheet in your appendix"></textarea>    
                            </div><br>
                            <div class="input-group w-60">
                                <h6>Break-Even Analysis:</h6>
                            </div>
                            <div class="input-group w-80">
                                <textarea class="form-control" name="analysis" rows="3" placeholder="[Share at which point in time and after how many dollars/units in sales are reached before you break even. You may want to attach a more in-depth break-even analysis in the appendix if this section gets too convoluted"></textarea>    
                            </div><br>
                            <div class="input-group w-60">
                                <h6>Projected P&L:</h6>
                            </div>
                            <div class="input-group w-80">
                                <textarea class="form-control" name="projected_pl" rows="3" placeholder="Explain your profit and loss projections for at least one year. If you’re expected to turn a profit shortly after one year, include that date in this section. If not, point readers to the full projected P&L in the appendix"></textarea>    
                            </div><br>
                            <div class="input-group w-60">
                                <h6>Funding Requirements:</h6>
                            </div>
                            <div class="input-group w-80">
                                <textarea class="form-control" name="funding_require" rows="3" placeholder="What funding will you need in the immediate future to make your business a success?]"></textarea>    
                            </div><br>
                            <div class="btn-group">
                                <input type="submit" value="save details" class="btn btn-primary">
                            </div>
                                            
                        </div>
                    
                        <div style="overflow:auto;">
                            <div style="float:right;">
                            <button class="btn btn-info" type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                            <button class="btn btn-info" type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                            </div>
                        </div>
                        
                        <div style="text-align:center;margin-top:40px;">
                            <span class="step"></span>
                            <span class="step"></span>
                            <span class="step"></span>
                            <span class="step"></span>
                            <span class="step"></span>
                            <span class="step"></span>
                            <span class="step"></span>
                            <span class="step"></span>
                            <span class="step"></span>
                            {{-- <span class="step"></span> --}}

                        </div>

                    </div>
                </form>

            </div>


    <script>

        function save_prepared_by() {

            var name = $("#name").val();
            var email = $("#email").val();
            var role = $("#role").val();
            var company_id = $("#company_id").val();

            $("#name").val('');
            $("#email").val('');
            $("#role").val('');


            $.ajax({
                type: 'POST',
                url: '/storePreparedBy',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "name":name,
                    "email":email,
                    "role":role,
                    "company_id":company_id,

                },

                success: function(response) {
                Swal.fire({
                    position: 'middle',
                    icon: 'success',
                    title: response[0],
                    // title:'Author Saved',
                    showConfirmButton: false,
                    timer: 1500
                })
                console.log(response);
                        
                }, error: function(data) {
                    console.log(data);
                }
            });
        }

        function delete_added_prepared_by(id) {
        var prepared_by_id = $("#prepared_by_id").val();
        // console.log(id);
        $("#saved_business_prepared_by_delete"+id).remove();


        $.ajax({
            type: 'POST',
            url: '/delete_added_prepared_by/'+id,
            data: {
            "_token": "{{ csrf_token() }}",
            "prepared_by_id":$("#prepared_by_id"+id).val(),
            },

            success: function(response) {
            console.log(response);
                    
            }, error: function(data) {
                console.log(data);
            }
            
        });
    }

        function save_summary() {

            var history = $("#history").val();
            var over_view = $("#over_view").val();
            var financial_project = $("#financial_project").val();
            var investors = $("#investors").val();
            var company_id = $("#company_id").val();

            // $("#history").val('');
            // $("#over_view").val('');
            // $("#financial_project").val('');
            // $("#investors").val('');



            $.ajax({
                type: 'POST',
                url: '/storeSummary',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "history":history,
                    "over_view":over_view,
                    "financial_project":financial_project,
                    "investors":investors,
                    "company_id":company_id,

                },

                success: function(response) {
                Swal.fire({
                    position: 'middle',
                    icon: 'success',
                    title: response,
                    // title:'Author Saved',
                    showConfirmButton: false,
                    timer: 1500
                })
                console.log(response);
                        
                }, error: function(data) {
                    console.log(data);
                }
            });
            $("#summary_form").remove();
        }

        function save_competitor() {

            var competitor_name = $("#competitor_name").val();
            var competitor_strength = $("#competitor_strength").val();
            var competitor_weak = $("#competitor_weak").val();
            var counterpoint = $("#counterpoint").val();
            var company_id = $("#company_id").val();

            $("#competitor_name").val('');
            $("#competitor_strength").val('');
            $("#competitor_weak").val('');
            $("#counterpoint").val('');



            $.ajax({
                type: 'POST',
                url: '/storeCompetitor',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "competitor_name":competitor_name,
                    "competitor_strength":competitor_strength,
                    "competitor_weak":competitor_weak,
                    "counterpoint":counterpoint,
                    "company_id":company_id,

                },

                success: function(response) {
                Swal.fire({
                    position: 'middle',
                    icon: 'success',
                    title: response[0],
                    // title:'Author Saved',
                    showConfirmButton: false,
                    timer: 1500
                })
                console.log(response);
                        
                }, error: function(data) {
                    console.log(data);
                }
            });
        }

    </script>       
    <script id="template" type="text/template">
        <div>
          <button class="previous" type="button">&lt;</button>
          <span><%= index %></span>
          <button class="next" type="button">&gt;</button>
          <a class="show-all" href="#">Show all pages</a>
          <progress value="<%= progress %>"></progress>
        </div>
      </script>
    <script>
        var currentTab = 0; // Current tab is set to be the first tab (0)
        showTab(currentTab); // Display the current tab

        function showTab(n) {
            // This function will display the specified tab of the form ...
            var x = document.getElementsByClassName("tab");
            x[n].style.display = "block";
            // ... and fix the Previous/Next buttons:
            if (n == 0) {
                document.getElementById("prevBtn").style.display = "none";
            } else {
                document.getElementById("prevBtn").style.display = "inline";
            }
            if (n == (x.length - 1)) {
                document.getElementById("nextBtn").style.display = "none";
            } else {
                document.getElementById("nextBtn").style.display = "inline";
                document.getElementById("nextBtn").innerHTML = "Next";
            }
            // ... and run a function that displays the correct step indicator:
            fixStepIndicator(n)
        }

        function nextPrev(n) {
            // This function will figure out which tab to display
            var x = document.getElementsByClassName("tab");
            // Exit the function if any field in the current tab is invalid:
            if (n == 1 && !validateForm()) return false;
            // Hide the current tab:
            x[currentTab].style.display = "none";
            // Increase or decrease the current tab by 1:
            currentTab = currentTab + n;
            // if you have reached the end of the form... :
            if (currentTab >= x.length) {
                //...the form gets submitted:
                document.getElementById("regForm").submit();
                return false;
            }
            // Otherwise, display the correct tab:
            showTab(currentTab);
        }

        function validateForm() {
            // This function deals with validation of the form fields
            var x, y, i, valid = true;
            x = document.getElementsByClassName("tab");
            y = x[currentTab].getElementsByTagName("input");
            // A loop that checks every input field in the current tab:
            for (i = 0; i < y.length; i++) {
                // If a field is empty...
                if (y[i].value == "") {
                    // add an "invalid" class to the field:
                    y[i].className += " invalid";
                    // and set the current valid status to false:
                    valid = false;
                }
            }
            // If the valid status is true, mark the step as finished and valid:
            if (valid) {
                document.getElementsByClassName("step")[currentTab].className += " finish";
            }
            // return valid; // return the valid status
            return true;
        }

        function fixStepIndicator(n) {
            // This function removes the "active" class of all steps...
            var i, x = document.getElementsByClassName("step");
            for (i = 0; i < x.length; i++) {
                x[i].className = x[i].className.replace(" active", "");
            }
            //... and adds the "active" class to the current step:
            x[n].className += " active";
        }
    </script>
{{-- </body>

</html> --}}
@endsection