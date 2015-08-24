@extends('layout.frontend')

@section('fcontent')
    <div class="row">
        <div class="large-12 columns">
            <div class="row">
                <div>
                    <h3>Please enter your shipping info</h3>
                </div>
                <div class="large-12 rows">
                <?php echo Form::open(array('url' =>'submit'));
                      echo "<div class='large-6 rows'>". Form::text('firstname','',array('placeholder'=>'First Name'))."</div>" ;
                      echo "<div class='large-6 rows'>". Form::text('lastname','',array('placeholder'=>'Last Name'))."</div>" ;
                      echo "<div class='large-6 rows'>". Form::textarea('adress','',array('placeholder'=>'Adress','rows'=>'2'))."</div>" ;
                      echo "<div class='large-4 rows'>". Form::text('city','',array('placeholder'=>'City'))."</div>" ;
                      echo "<div class='large-4 rows'>". Form::text('zipcode','',array('placeholder'=>'Zipcode'))."</div>" ;
                      echo "<div class='large-4 rows'>". Form::tel('phonenr','',array('placeholder'=>'Phone Number'))."</div>" ;
                      echo "<div class='large-4 rows'>". Form::email('email','',array('placeholder'=>'Email'))."</div>" ;
                      echo "<div class='large-4 rows'>". Form::button('Submit','',array('type'=>'submit'))."</div>" ;
                      echo Form::close(); ?>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
    @parent
    <script>
        $(document).ready(function(){

        });
    </script>
@endsection
