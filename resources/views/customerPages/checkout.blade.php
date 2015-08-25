@extends('layout.frontend')

@section('fcontent')

    <div class="row">
        <div class="large-12 columns">
            <div class="row">
                <div>
                    <h3>Please enter your shipping info</h3>
                </div>
                @if (count($errors) > 0)
                    <div data-alert="" class="alert-box alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>

                    </div>
                @endif
                <div class="large-12 rows">
                    @if($user ==null)
                <?php echo Form::open(array('url' =>'postCheckout'));
                      echo "<div class='large-6 rows'><label><b>First name</b></label>". Form::text('firstname',Input::old('firstname'),array('placeholder'=>'First Name'))."</div>" ;
                      echo "<div class='large-6 rows'><label><b>Last name</b></label>". Form::text('lastname',Input::old('lastname'),array('placeholder'=>'Last Name'))."</div>" ;
                      echo "<div class='large-6 rows'><label><b>Adress</b></label>". Form::textarea('adres',Input::old('adres'),array('placeholder'=>'Adress','rows'=>'2'))."</div>" ;
                      echo "<div class='large-4 rows'><label><b>City</b></label>". Form::text('city',Input::old('city'),array('placeholder'=>'City'))."</div>" ;
                      echo "<div class='large-4 rows'><label><b>Zipcode</b></label>". Form::text('zip',Input::old('zip'),array('placeholder'=>'Zip'))."</div>" ;
                      echo "<div class='large-4 rows'><label><b>Telephone number</b></label>". Form::tel('telephone',Input::old('telephone'),array('placeholder'=>'Telephone'))."</div>" ;
                      echo "<div class='large-4 rows'><label><b>Email</b></label>". Form::email('email',Input::old('email'),array('placeholder'=>'Email'))."</div>" ;
                      echo '<div class="large-4 rows"><button type="submit" role="button" aria-label="submit form" class="button">Submit</button>' ;
                      echo Form::close(); ?>
                    @elseif($user != null)
                        <?php echo Form::open(array('url' =>'postCheckout'));
                        echo "<div class='large-6 rows'><label><b>First name</b></label>". Form::text('firstname',$user->name,array('placeholder'=>'First Name'))."</div>" ;
                        echo "<div class='large-6 rows'><label><b>Last name</b></label>". Form::text('lastname',$user->lastname,array('placeholder'=>'Last Name'))."</div>" ;
                        echo "<div class='large-6 rows'><label><b>Adress</b></label>". Form::textarea('adres',$user->adress,array('placeholder'=>'Adress','rows'=>'2'))."</div>" ;
                        echo "<div class='large-4 rows'><label><b>City</b></label>". Form::text('city',$user->city,array('placeholder'=>'City'))."</div>" ;
                        echo "<div class='large-4 rows'><label><b>Zip</b></label>". Form::text('zip',$user->zip,array('placeholder'=>'Zip'))."</div>" ;
                        echo "<div class='large-4 rows'><label><b>Telephone number</b></label>". Form::tel('telephone',Input::old('telephone'),array('placeholder'=>'Telephone'))."</div>" ;
                        echo "<div class='large-4 rows'><label><b>Email</b></label>". Form::email('email',$user->email,array('placeholder'=>'Email'))."</div>" ;
                        echo '<div class="large-4 rows"><button type="submit" role="button" aria-label="submit form" class="button">Submit</button>' ;
                        echo Form::close(); ?>
                      @endif
                </div>
            </div>
        </div>
    </div>


@endsection


