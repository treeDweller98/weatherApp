<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Weather</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200&display=swap" rel="stylesheet"> 

    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="css/scrollspy-sidebar.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.bundle.min.js" defer></script>
    <script src="js/jquery-3.6.0.min.js"></script>
</head>

<body>
    <aside class="scrollspy-bar">
        <ul>
            <li> <a href="#WeatherToday" class="dot" data-scroll="WeatherToday"><span>Weather Now</span></a></li>
            <li> <a href="#Forecast" class="dot" data-scroll="Forecast"><span>Forecasts</span></a></li>
        </ul>

        <script>
            $(document).ready(function(){

                $(window).on('scroll',function(){
                
                    var link = $('.scrollspy-bar a.dot');
                    var top = $(window).scrollTop();
                
                    $('.sec').each(function(){
                        var id = $(this).attr('id');
                        var height = $(this).height();
                        var offset = $(this).offset().top - 150;
                        if(top >= offset && top < offset + height){
                            link.removeClass('active');
                            $('.scrollspy-bar').find('[data-scroll="' + id + '"]').addClass('active');
                        }
                    });
                
                });
                
            });
        </script>
    </aside>

    <main>
        <?php
            $API_KEY = "cb139e88f1d02432577e84c274789671";

            // User inputs
            if ( isset($_POST['city']) && isset($_POST['country']) ) {
                $city = $_POST['city'];
                $country = $_POST['country'];
            } else {
                $city = 'dhaka';
                $country = 'bd';
            }


            // Get coordinates of user location
            $url = "http://api.openweathermap.org/geo/1.0/direct?q={$city},{$country}&limit=1&appid={$API_KEY}";
            $location = json_decode( file_get_contents($url) );
            
            $latitude = $location[0]->lat;
            $longitude = $location[0]->lon;
            $cityName = $location[0]->name;
            $locationName = $cityName . ", " . $location[0]->state . ", " . $location[0]->country ;
            
            // Get weather data
            $url = "https://api.openweathermap.org/data/2.5/onecall?lat={$latitude}&lon={$longitude}&units=metric&exclude=minutely,hourly&appid={$API_KEY}";
            $weather = json_decode( file_get_contents($url) );
            

            // Package current weather data
            $current = $weather->current;
            $iconURL = "https://openweathermap.org/img/wn/" . $current->weather[0]->icon .".png";
            $description = $current->weather[0]->description;
            $temperature = $current->temp;
            $feelsLike = $current->feels_like;
            $humidity = $current->humidity;
            $windSpeed = $current->wind_speed; 
            $windDegree = ($current->wind_deg < 100) ? ("0" . strval($current->wind_deg)) : $current->wind_deg;
            $wind = $windSpeed."m/s at ".$windDegree ."°";
            $clouds = $current->clouds;
            $uvi = $current->uvi;
            $visibility = $current->visibility;
            $pressure = $current->pressure;
        ?>

        <section id="WeatherToday" class="sec d-flex justify-content-center align-items-center">
            <div class="transbox">
                <form action="index.php" method="POST" class="needs-validation" novalidate>
        
                    <div class="input-group input-group-sm rounded-pill d-inline-flex justify-content-center py-3">
                        <!-- Select Country -->
                        <div class="col-sm-12 col-md-4">
                            <select name="country" class="form-select rounded-pill" id="countryDropdown" required>
                                <option selected disabled value="">Select Country</option>
                                <optgroup id="country-optgroup-Africa" label="Africa">
                                    <option value="DZ" label="Algeria">Algeria</option>
                                    <option value="AO" label="Angola">Angola</option>
                                    <option value="BJ" label="Benin">Benin</option>
                                    <option value="BW" label="Botswana">Botswana</option>
                                    <option value="BF" label="Burkina Faso">Burkina Faso</option>
                                    <option value="BI" label="Burundi">Burundi</option>
                                    <option value="CM" label="Cameroon">Cameroon</option>
                                    <option value="CV" label="Cape Verde">Cape Verde</option>
                                    <option value="CF" label="Central African Republic">Central African Republic</option>
                                    <option value="TD" label="Chad">Chad</option>
                                    <option value="KM" label="Comoros">Comoros</option>
                                    <option value="CG" label="Congo - Brazzaville">Congo - Brazzaville</option>
                                    <option value="CD" label="Congo - Kinshasa">Congo - Kinshasa</option>
                                    <option value="CI" label="Côte d’Ivoire">Côte d’Ivoire</option>
                                    <option value="DJ" label="Djibouti">Djibouti</option>
                                    <option value="EG" label="Egypt">Egypt</option>
                                    <option value="GQ" label="Equatorial Guinea">Equatorial Guinea</option>
                                    <option value="ER" label="Eritrea">Eritrea</option>
                                    <option value="ET" label="Ethiopia">Ethiopia</option>
                                    <option value="GA" label="Gabon">Gabon</option>
                                    <option value="GM" label="Gambia">Gambia</option>
                                    <option value="GH" label="Ghana">Ghana</option>
                                    <option value="GN" label="Guinea">Guinea</option>
                                    <option value="GW" label="Guinea-Bissau">Guinea-Bissau</option>
                                    <option value="KE" label="Kenya">Kenya</option>
                                    <option value="LS" label="Lesotho">Lesotho</option>
                                    <option value="LR" label="Liberia">Liberia</option>
                                    <option value="LY" label="Libya">Libya</option>
                                    <option value="MG" label="Madagascar">Madagascar</option>
                                    <option value="MW" label="Malawi">Malawi</option>
                                    <option value="ML" label="Mali">Mali</option>
                                    <option value="MR" label="Mauritania">Mauritania</option>
                                    <option value="MU" label="Mauritius">Mauritius</option>
                                    <option value="YT" label="Mayotte">Mayotte</option>
                                    <option value="MA" label="Morocco">Morocco</option>
                                    <option value="MZ" label="Mozambique">Mozambique</option>
                                    <option value="NA" label="Namibia">Namibia</option>
                                    <option value="NE" label="Niger">Niger</option>
                                    <option value="NG" label="Nigeria">Nigeria</option>
                                    <option value="RW" label="Rwanda">Rwanda</option>
                                    <option value="RE" label="Réunion">Réunion</option>
                                    <option value="SH" label="Saint Helena">Saint Helena</option>
                                    <option value="SN" label="Senegal">Senegal</option>
                                    <option value="SC" label="Seychelles">Seychelles</option>
                                    <option value="SL" label="Sierra Leone">Sierra Leone</option>
                                    <option value="SO" label="Somalia">Somalia</option>
                                    <option value="ZA" label="South Africa">South Africa</option>
                                    <option value="SD" label="Sudan">Sudan</option>
                                    <option value="SZ" label="Swaziland">Swaziland</option>
                                    <option value="ST" label="São Tomé and Príncipe">São Tomé and Príncipe</option>
                                    <option value="TZ" label="Tanzania">Tanzania</option>
                                    <option value="TG" label="Togo">Togo</option>
                                    <option value="TN" label="Tunisia">Tunisia</option>
                                    <option value="UG" label="Uganda">Uganda</option>
                                    <option value="EH" label="Western Sahara">Western Sahara</option>
                                    <option value="ZM" label="Zambia">Zambia</option>
                                    <option value="ZW" label="Zimbabwe">Zimbabwe</option>
                                </optgroup>
                                <optgroup id="country-optgroup-Americas" label="Americas">
                                    <option value="AI" label="Anguilla">Anguilla</option>
                                    <option value="AG" label="Antigua and Barbuda">Antigua and Barbuda</option>
                                    <option value="AR" label="Argentina">Argentina</option>
                                    <option value="AW" label="Aruba">Aruba</option>
                                    <option value="BS" label="Bahamas">Bahamas</option>
                                    <option value="BB" label="Barbados">Barbados</option>
                                    <option value="BZ" label="Belize">Belize</option>
                                    <option value="BM" label="Bermuda">Bermuda</option>
                                    <option value="BO" label="Bolivia">Bolivia</option>
                                    <option value="BR" label="Brazil">Brazil</option>
                                    <option value="VG" label="British Virgin Islands">British Virgin Islands</option>
                                    <option value="CA" label="Canada">Canada</option>
                                    <option value="KY" label="Cayman Islands">Cayman Islands</option>
                                    <option value="CL" label="Chile">Chile</option>
                                    <option value="CO" label="Colombia">Colombia</option>
                                    <option value="CR" label="Costa Rica">Costa Rica</option>
                                    <option value="CU" label="Cuba">Cuba</option>
                                    <option value="DM" label="Dominica">Dominica</option>
                                    <option value="DO" label="Dominican Republic">Dominican Republic</option>
                                    <option value="EC" label="Ecuador">Ecuador</option>
                                    <option value="SV" label="El Salvador">El Salvador</option>
                                    <option value="FK" label="Falkland Islands">Falkland Islands</option>
                                    <option value="GF" label="French Guiana">French Guiana</option>
                                    <option value="GL" label="Greenland">Greenland</option>
                                    <option value="GD" label="Grenada">Grenada</option>
                                    <option value="GP" label="Guadeloupe">Guadeloupe</option>
                                    <option value="GT" label="Guatemala">Guatemala</option>
                                    <option value="GY" label="Guyana">Guyana</option>
                                    <option value="HT" label="Haiti">Haiti</option>
                                    <option value="HN" label="Honduras">Honduras</option>
                                    <option value="JM" label="Jamaica">Jamaica</option>
                                    <option value="MQ" label="Martinique">Martinique</option>
                                    <option value="MX" label="Mexico">Mexico</option>
                                    <option value="MS" label="Montserrat">Montserrat</option>
                                    <option value="AN" label="Netherlands Antilles">Netherlands Antilles</option>
                                    <option value="NI" label="Nicaragua">Nicaragua</option>
                                    <option value="PA" label="Panama">Panama</option>
                                    <option value="PY" label="Paraguay">Paraguay</option>
                                    <option value="PE" label="Peru">Peru</option>
                                    <option value="PR" label="Puerto Rico">Puerto Rico</option>
                                    <option value="BL" label="Saint Barthélemy">Saint Barthélemy</option>
                                    <option value="KN" label="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                    <option value="LC" label="Saint Lucia">Saint Lucia</option>
                                    <option value="MF" label="Saint Martin">Saint Martin</option>
                                    <option value="PM" label="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                    <option value="VC" label="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                                    <option value="SR" label="Suriname">Suriname</option>
                                    <option value="TT" label="Trinidad and Tobago">Trinidad and Tobago</option>
                                    <option value="TC" label="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                    <option value="VI" label="U.S. Virgin Islands">U.S. Virgin Islands</option>
                                    <option value="US" label="United States">United States</option>
                                    <option value="UY" label="Uruguay">Uruguay</option>
                                    <option value="VE" label="Venezuela">Venezuela</option>
                                </optgroup>
                                <optgroup id="country-optgroup-Asia" label="Asia">
                                    <option value="AF" label="Afghanistan">Afghanistan</option>
                                    <option value="AM" label="Armenia">Armenia</option>
                                    <option value="AZ" label="Azerbaijan">Azerbaijan</option>
                                    <option value="BH" label="Bahrain">Bahrain</option>
                                    <option value="BD" label="Bangladesh">Bangladesh</option>
                                    <option value="BT" label="Bhutan">Bhutan</option>
                                    <option value="BN" label="Brunei">Brunei</option>
                                    <option value="KH" label="Cambodia">Cambodia</option>
                                    <option value="CN" label="China">China</option>
                                    <option value="GE" label="Georgia">Georgia</option>
                                    <option value="HK" label="Hong Kong SAR China">Hong Kong SAR China</option>
                                    <option value="IN" label="India">India</option>
                                    <option value="ID" label="Indonesia">Indonesia</option>
                                    <option value="IR" label="Iran">Iran</option>
                                    <option value="IQ" label="Iraq">Iraq</option>
                                    <option value="IL" label="Israel">Israel</option>
                                    <option value="JP" label="Japan">Japan</option>
                                    <option value="JO" label="Jordan">Jordan</option>
                                    <option value="KZ" label="Kazakhstan">Kazakhstan</option>
                                    <option value="KW" label="Kuwait">Kuwait</option>
                                    <option value="KG" label="Kyrgyzstan">Kyrgyzstan</option>
                                    <option value="LA" label="Laos">Laos</option>
                                    <option value="LB" label="Lebanon">Lebanon</option>
                                    <option value="MO" label="Macau SAR China">Macau SAR China</option>
                                    <option value="MY" label="Malaysia">Malaysia</option>
                                    <option value="MV" label="Maldives">Maldives</option>
                                    <option value="MN" label="Mongolia">Mongolia</option>
                                    <option value="MM" label="Myanmar [Burma]">Myanmar [Burma]</option>
                                    <option value="NP" label="Nepal">Nepal</option>
                                    <option value="NT" label="Neutral Zone">Neutral Zone</option>
                                    <option value="KP" label="North Korea">North Korea</option>
                                    <option value="OM" label="Oman">Oman</option>
                                    <option value="PK" label="Pakistan">Pakistan</option>
                                    <option value="PS" label="Palestinian Territories">Palestinian Territories</option>
                                    <option value="YD" label="People's Democratic Republic of Yemen">People's Democratic Republic of Yemen</option>
                                    <option value="PH" label="Philippines">Philippines</option>
                                    <option value="QA" label="Qatar">Qatar</option>
                                    <option value="SA" label="Saudi Arabia">Saudi Arabia</option>
                                    <option value="SG" label="Singapore">Singapore</option>
                                    <option value="KR" label="South Korea">South Korea</option>
                                    <option value="LK" label="Sri Lanka">Sri Lanka</option>
                                    <option value="SY" label="Syria">Syria</option>
                                    <option value="TW" label="Taiwan">Taiwan</option>
                                    <option value="TJ" label="Tajikistan">Tajikistan</option>
                                    <option value="TH" label="Thailand">Thailand</option>
                                    <option value="TL" label="Timor-Leste">Timor-Leste</option>
                                    <option value="TR" label="Turkey">Turkey</option>
                                    <option value="TM" label="Turkmenistan">Turkmenistan</option>
                                    <option value="AE" label="United Arab Emirates">United Arab Emirates</option>
                                    <option value="UZ" label="Uzbekistan">Uzbekistan</option>
                                    <option value="VN" label="Vietnam">Vietnam</option>
                                    <option value="YE" label="Yemen">Yemen</option>
                                </optgroup>
                                <optgroup id="country-optgroup-Europe" label="Europe">
                                    <option value="AL" label="Albania">Albania</option>
                                    <option value="AD" label="Andorra">Andorra</option>
                                    <option value="AT" label="Austria">Austria</option>
                                    <option value="BY" label="Belarus">Belarus</option>
                                    <option value="BE" label="Belgium">Belgium</option>
                                    <option value="BA" label="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                    <option value="BG" label="Bulgaria">Bulgaria</option>
                                    <option value="HR" label="Croatia">Croatia</option>
                                    <option value="CY" label="Cyprus">Cyprus</option>
                                    <option value="CZ" label="Czech Republic">Czech Republic</option>
                                    <option value="DK" label="Denmark">Denmark</option>
                                    <option value="DD" label="East Germany">East Germany</option>
                                    <option value="EE" label="Estonia">Estonia</option>
                                    <option value="FO" label="Faroe Islands">Faroe Islands</option>
                                    <option value="FI" label="Finland">Finland</option>
                                    <option value="FR" label="France">France</option>
                                    <option value="DE" label="Germany">Germany</option>
                                    <option value="GI" label="Gibraltar">Gibraltar</option>
                                    <option value="GR" label="Greece">Greece</option>
                                    <option value="GG" label="Guernsey">Guernsey</option>
                                    <option value="HU" label="Hungary">Hungary</option>
                                    <option value="IS" label="Iceland">Iceland</option>
                                    <option value="IE" label="Ireland">Ireland</option>
                                    <option value="IM" label="Isle of Man">Isle of Man</option>
                                    <option value="IT" label="Italy">Italy</option>
                                    <option value="JE" label="Jersey">Jersey</option>
                                    <option value="LV" label="Latvia">Latvia</option>
                                    <option value="LI" label="Liechtenstein">Liechtenstein</option>
                                    <option value="LT" label="Lithuania">Lithuania</option>
                                    <option value="LU" label="Luxembourg">Luxembourg</option>
                                    <option value="MK" label="Macedonia">Macedonia</option>
                                    <option value="MT" label="Malta">Malta</option>
                                    <option value="FX" label="Metropolitan France">Metropolitan France</option>
                                    <option value="MD" label="Moldova">Moldova</option>
                                    <option value="MC" label="Monaco">Monaco</option>
                                    <option value="ME" label="Montenegro">Montenegro</option>
                                    <option value="NL" label="Netherlands">Netherlands</option>
                                    <option value="NO" label="Norway">Norway</option>
                                    <option value="PL" label="Poland">Poland</option>
                                    <option value="PT" label="Portugal">Portugal</option>
                                    <option value="RO" label="Romania">Romania</option>
                                    <option value="RU" label="Russia">Russia</option>
                                    <option value="SM" label="San Marino">San Marino</option>
                                    <option value="RS" label="Serbia">Serbia</option>
                                    <option value="CS" label="Serbia and Montenegro">Serbia and Montenegro</option>
                                    <option value="SK" label="Slovakia">Slovakia</option>
                                    <option value="SI" label="Slovenia">Slovenia</option>
                                    <option value="ES" label="Spain">Spain</option>
                                    <option value="SJ" label="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                    <option value="SE" label="Sweden">Sweden</option>
                                    <option value="CH" label="Switzerland">Switzerland</option>
                                    <option value="UA" label="Ukraine">Ukraine</option>
                                    <option value="SU" label="Union of Soviet Socialist Republics">Union of Soviet Socialist Republics</option>
                                    <option value="GB" label="United Kingdom">United Kingdom</option>
                                    <option value="VA" label="Vatican City">Vatican City</option>
                                    <option value="AX" label="Åland Islands">Åland Islands</option>
                                </optgroup>
                                <optgroup id="country-optgroup-Oceania" label="Oceania">
                                    <option value="AS" label="American Samoa">American Samoa</option>
                                    <option value="AQ" label="Antarctica">Antarctica</option>
                                    <option value="AU" label="Australia">Australia</option>
                                    <option value="BV" label="Bouvet Island">Bouvet Island</option>
                                    <option value="IO" label="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                    <option value="CX" label="Christmas Island">Christmas Island</option>
                                    <option value="CC" label="Cocos [Keeling] Islands">Cocos [Keeling] Islands</option>
                                    <option value="CK" label="Cook Islands">Cook Islands</option>
                                    <option value="FJ" label="Fiji">Fiji</option>
                                    <option value="PF" label="French Polynesia">French Polynesia</option>
                                    <option value="TF" label="French Southern Territories">French Southern Territories</option>
                                    <option value="GU" label="Guam">Guam</option>
                                    <option value="HM" label="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option>
                                    <option value="KI" label="Kiribati">Kiribati</option>
                                    <option value="MH" label="Marshall Islands">Marshall Islands</option>
                                    <option value="FM" label="Micronesia">Micronesia</option>
                                    <option value="NR" label="Nauru">Nauru</option>
                                    <option value="NC" label="New Caledonia">New Caledonia</option>
                                    <option value="NZ" label="New Zealand">New Zealand</option>
                                    <option value="NU" label="Niue">Niue</option>
                                    <option value="NF" label="Norfolk Island">Norfolk Island</option>
                                    <option value="MP" label="Northern Mariana Islands">Northern Mariana Islands</option>
                                    <option value="PW" label="Palau">Palau</option>
                                    <option value="PG" label="Papua New Guinea">Papua New Guinea</option>
                                    <option value="PN" label="Pitcairn Islands">Pitcairn Islands</option>
                                    <option value="WS" label="Samoa">Samoa</option>
                                    <option value="SB" label="Solomon Islands">Solomon Islands</option>
                                    <option value="GS" label="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option>
                                    <option value="TK" label="Tokelau">Tokelau</option>
                                    <option value="TO" label="Tonga">Tonga</option>
                                    <option value="TV" label="Tuvalu">Tuvalu</option>
                                    <option value="UM" label="U.S. Minor Outlying Islands">U.S. Minor Outlying Islands</option>
                                    <option value="VU" label="Vanuatu">Vanuatu</option>
                                    <option value="WF" label="Wallis and Futuna">Wallis and Futuna</option>
                                </optgroup>
                            </select>
                            <div class="invalid-feedback">Please select a country</div>
                        </div>
                        
                        <!-- Type City Name -->
                        <div class="col-sm-10 col-md-4">
                            <input class="form-control rounded-pill" name="city" placeholder="Type city name" required>
                            <div class="invalid-feedback">Please enter a valid city name</div>
                        </div>
                        <!-- Search city -->
                        <div class="col-sm-2 col-md-2">
                            <button type="submit" value="Submit" class="btn rounded-circle mx-2">
                                <img src="img/icons/search.png" width="16px">
                            </button>
                        </div>
                    </div>
    
                    <script>
                        // JavaScript for disabling form submissions if there are invalid fields
                        $(document).ready(function () {
                            'use strict'
                        
                            // Fetch all the forms we want to apply custom Bootstrap validation styles to
                            var forms = document.querySelectorAll('.needs-validation')
                        
                            // Loop over them and prevent submission
                            Array.prototype.slice.call(forms)
                            .forEach(function (form) {
                                form.addEventListener('submit', function (event) {
                                if (!form.checkValidity()) {
                                    event.preventDefault()
                                    event.stopPropagation()
                                }
                        
                                form.classList.add('was-validated')
                                }, false)
                            })
                        })()
                    </script>
                </form>
                
                <div class="d-flex flex-column align-items-center">
                    <!-- Location -->
                    <div class="d-inline-flex align-items-center py-5">
                        <div>
                            <h2 class="text-center my-0 me-3">
                                Weather in <?php echo $cityName; ?>
                            </h2>
                            <span class="text-muted fs-6"><?php echo $locationName; ?></span>
                        </div>
                        <img src="img/icons/location.png" alt="" height="64px">
                    </div>

                    <!-- Temperature and Condition -->
                    <div class="d-inline-flex align-items-start mb-5">
                       <img src="img/icons/temperature.png" alt="Temperature Today" height="72px">
                       <div>
                           <h1 class="m-0">
                               <?php echo $temperature; ?>&degC
                           </h1>
                           <span class="text-muted fs-6">Feels like <?php echo $feelsLike; ?>&degC</span>
                       </div>

                       <div class="ms-5">
                           <h1>
                               <?php echo $description; ?>
                           </h1>
                       </div>
                       <img src="<?php echo $iconURL; ?>" alt="<?php echo $description; ?>">
                   </div>

                    <div class="container">
                        <div class="row d-flex justify-content-between">
                            <div class="col me-5">
                                <!-- Humidity -->
                                <h6>
                                    <img src="img/icons/humidity.png" alt="Humidity" height="32px">
                                    <span class="text-muted pe-3 ps-1">Humidity: </span><?php echo $humidity; ?>%
                                </h6> 
    
                                <!-- Wind -->
                                <h6>
                                    <img src="img/icons/wind.png" alt="Wind" height="32px">
                                    <span class="text-muted pe-3 ps-1">Wind: </span><?php echo $wind; ?>
                                </h6>
                                <!-- Pressure -->
                                <h6>
                                    <img src="img/icons/barometer.png" alt="Wind" height="32px">
                                    <span class="text-muted pe-3 ps-1">Pressure: </span><?php echo $pressure; ?>hPa
                                </h6>
                            </div>
                            <div class="col ms-5">
                                <!-- Cloud cover -->
                                <h6>
                                    <img src="img/icons/cloud.png" alt="Cloud" height="32px">
                                    <span class="text-muted pe-3 ps-1">Cloudiness: </span><?php echo $clouds; ?>%
                                </h6>
                                <!-- UV index -->
                                <h6>
                                    <img src="img/icons/uv-index.png" alt="UV" height="32px">
                                    <span class="text-muted pe-3 ps-1">UV Index: </span><?php echo $uvi; ?>
                                </h6>
                                <!-- Visibility -->
                                <h6>
                                    <img src="img/icons/visibility.png" alt="UV" height="32px">
                                    <span class="text-muted pe-3 ps-1">Avg. Visibility: </span><?php echo $visibility; ?>m
                                </h6>
                            </div>
                       </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="Forecast" class="sec">
            <div class="container p-0">
                <div class="row">
                    <?php
                        foreach ( $weather->daily as $day ) {
                            // Package relevant weather data
                            $date = (new DateTime('@' . $day->dt))->setTimezone(new DateTimeZone($weather->timezone))->format('D d-M');
                            $iconURL = "https://openweathermap.org/img/wn/" . $day->weather[0]->icon .".png";
                            $description = $day->weather[0]->description;
                            $tempDay = $day->temp->day;
                            $tempNight = $day->temp->night;
                            $feelDay = $day->feels_like->day;
                            $feelNight = $day->feels_like->night;
                            $humidity = $day->humidity;
                            $windSpeed = $day->wind_speed; 
                            $windDegree = ($day->wind_deg < 100) ? ("0" . strval($day->wind_deg)) : $day->wind_deg;
                            $wind = $windSpeed."m/s at ".$windDegree ."°";
                            $clouds = $day->clouds;


                            // Echo html for card
                            echo <<< EOT
                            <div class='col-lg-6 col-sm-12'>
                                <div class="card text-white bg-dark shadow p-3 mb-2">

                                    <div class="d-flex p-3">
                                        <img class="img-fluid" src="{$iconURL}" alt="{$description}">
                                        <div>
                                            <h5 class="card-title">{$date}</h5>
                                            <h6 class="card-subtitle mb-2 text-muted">{$description}</h6>
                                        </div>
                                    </div>
        
                                    <div class="d-inline-flex align-items-center pb-3 px-3">
                                        <img src="img/icons/sun.png" alt="Day Temperature" height="64px" class="pe-4">
                                        <div>
                                            <h3 class="m-0">{$tempDay}&degC</h3>
                                            <span class="text-muted fs-6">Feels like {$feelDay}&degC</span>
                                        </div>
                                        <div class="px-5"></div>
                                        <div>
                                            <h3 class="m-0">{$tempNight}&degC</h3>
                                            <span class="text-muted fs-6">Feels like {$feelNight}&degC</span>
                                        </div>
                                        <img src="img/icons/moon.png" alt="Night Temperature" height="64px" class="ps-4">
                                    </div>
    
                                    <div class="d-flex flex-column p-3">
                                        <h6>
                                            <img src="img/icons/humidity.png" alt="Humidity" height="16px">
                                            <span class="text-muted pe-3 ps-1">Humidity: </span>{$humidity}%
                                        </h6> 
                                        <h6>
                                            <img src="img/icons/wind.png" alt="Wind" height="16px">
                                            <span class="text-muted pe-3 ps-1">Wind: </span> {$wind}
                                        </h6>
                                        <h6>
                                            <img src="img/icons/cloud.png" alt="Cloud" height="16px">
                                            <span class="text-muted pe-3 ps-1">Cloudiness: </span> {$clouds}%
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            EOT;
                        }
                    ?>
                </div>
            </div>
        </section>

    </main>

    <footer>
        <p>&copy 2022 Fahim Ahmed</p>
        <small> 
            Made with ♥ <br>
            CSE309-1 Assignment 3. Spring 2022
        </small>
    </footer>
</body>

</html>