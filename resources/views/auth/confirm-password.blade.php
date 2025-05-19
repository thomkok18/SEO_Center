<x-guest-layout
    :name-page="'Confirm Password'"
    :active-page="''"
    :css="asset('css/auth/confirm-password.min.css')"
    :font-awesome="false"
    :class="'login-page sidebar-mini '"
    :background-image="asset('assets/img/bg14.webp')"
>
    <div class="content">
        <div class="container">
            <div class="col-md-12 ml-auto mr-auto">
                <div class="header bg-gradient-primary py-10 py-lg-2 pt-lg-12">
                    <div class="container">
                        <div class="header-body text-center mb-7">
                            <div class="row justify-content-center">
                                <div class="col-lg-12 col-md-9">
                                    <p class="text-lead text-light mt-3 mb-0">
                                        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 ml-auto mr-auto">
                <form role="form" method="POST" action="{{ route('password.confirm') }}">
                    @csrf
                    <div class="card card-login card-plain">
                        <div class="card-header ">
                            <div class="logo-container" style="height: 70px;">
                                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIIAAACMCAMAAACH14G/AAABd1BMVEUAAAD////////////8/Pz////////////////////////////////////////////////////////7+/v////////7+/v////+/v7////////////////////////////+/v7////////////////////////////////////////////////////g4ODFxcX////+/v7////19fXLy8v////////Y2NjR0dH////////////+/v7t7e3m5ub////+/v7////////////////////////////+/v76+vr19fXw8PDe3t739/f8/Pz8/PzX19f9/f3q6ur9/f3w8PDi4uLf39/////a2trw8PDJycnz8/Pv7+/8/Pzk5OTR0dHV1dXZ2dn////19fXr6+vp6eni4uLz8/Pe3t78/Pz39/fg4ODv7+/5+fnx8fHV1dXS0tLm5ubX19ft7e3k5OTNzc3b29vZ2dn7+/vPz8/KysrU1NTGxsZu0OqwAAAAYnRSTlMAM2YEAriv/hQwIfsHJwliGRYOEC0bCysSIx1fHy8qVLZbRzu/V6TIqUspJQrCuLiYT+i4uEQ+uLifNvjNuLirlIJ3vJ1cWDjvr6+vqqmNbif259nHxMKhbEUg6tCfhIKAZslNwlkAAAcJSURBVHja7JTLC9NAEMan7mA3cZPuJmneSU1ikT48VLCHIoiCehEUUREFld4UvPvnW227TbS2m0cv0t+h0MPMfDvfl4EGENPyxVAPDM9xEk1LHMczAn0ofMskcDnkcBFvJmu9o2gbLbG4mBAkjG6m9xTY6KCMYNfPt0ND69VAM0K7u2Ugo3rSa0CiU4advF8/uv3fKUzTdDrd/PzO5VFP9La7QJNPjww3dE5td24yQgji5oeZc9emXDeOCJlyE5sLsAPtr1dxm+Ep02z+19a0wMZmDtBqALVp7CvlHAnz42m11qCkiYBKsgzhklr1rjAqGa4rAn2jUi7m2MDHuah28VG91iqXpkMTGmMO07IIS1HEXNcOJs58gu2Oqj8rtdPnKiYKp1RhIbQGrdKbHHE2Eu7sICCeQ0fM44OImXt6BUNNCghNhM5AMzx0Hv57EXhYgRaoWqBuR6AdFvGP5khlCjwfoXPQ92QiKB41ISxvqimqPodHRrjyFgQuwoVAN5A3woUqaHv7HXECF4RwZ2+2jdUY7Dc0teDCWNO93xTLHpUsuijV0B0yR/RSUBVBZlE+DIzU81IjGHJqMfVa+enp5A8FqdotIKYfrPLF+OnghmTwdLzIV4FvErUbkUoNFQUGU3vBg3FpdpXB+IHaJplR0oDB4c85zLjI5Ph/ysiK2IRzyIcHCLameI6IeD6S88+oGD0XRPFMaTbQrRiOcAokeh4dH3dcVpTr5ExLvp1MwU1+SeFnrEtHf9s+WT7vJZ5heEnv+XLyd0BG6Zlw8V97SFxA4Wne6QiZTrV/tigCajKCsgqRMJMGxSKrqnTM09HejBYIgMxleDI4i5KAaFToPvvntny9GEUlEYsTIZejz2E/KAnIiiGDM7BhkZVEPLChHSyJSt1ConqCS7qjhEEL6ES2ypaCgDJELDMpfUKhKSSQbaKCItQCaRFJ+QFpaMJKriAX0ACRy0WsGplhTeQHHpOGa4zlOZlYUBek++po5UJj3FW0f0dtJ/l4V/osRmgBxs92jca8XqP46T4FLrTE3SfiaQw14NHOBIdAa4iz78ZrFOW7Gh2hA1DfacjVH8S2UcxC6Igw20aSqW9huc0wdMb2+1qSOjdhMMht6BA7Hwzq3QaTCwadwgQ34cqVK1euXLly5X8FX71/8e7ti/evEGpCjJeP7tx79GRKoBX259ff1hu+fvzkQy3o4/v99S/uPxbQgg/vvq939N+8ghrod9aSuzNojPX2x1rSfxiCMv69fqnyLoWG4Jfv6xL921w5B09uVSofk6Y2vF5XuanqqrhfLbwfQjN+9m7vP2lDUQDHT0QooY4grATZ4kgkwLKh+NjU4ANlMT6mxrjEmGw/7JY3CAgCov7xa7Vz9NqT1eq5X5D4C+aTe89tIwm/rxlX3uY6vGNcx+Cs74xPzttbhwzjWgVnbbCneRSwUerJ28BZ68wiWzPpYVxucNasFUGKBwQSVqqWBrcijjDXZJZ5FHGEFrPOrQgj3BUlS4KUDggj9LqIIRYVQ1i6uek1mHWxgCgCbkgrQgg9rXYD2Yu4IuK6MNS7RffCJ4DQvq/VxM8mPeH2PswgpRVqwnLLaNBE5iHvoyZ0Op3BoKPVL2Pz8J6Y0H+sghniUdqbdeVfdRWZh6RCSqiPVFKxczFFSSiVrkqPXaKGKB1h49JcDTEko3SEorlCTUauDz4qwnq3cF+3YPQjJWPzQEVocB14N9GzSUNYLHPtg9+D7MValIagcu0DeFOIIf6JhHDBtQcAkymJWZafIiDEqlwe0AptIoak7/UJbuv/DIMpbB58oggwmZCRc/FGFAG82DzEfaII4MeuUcZeeCQtfW/0h0RCgAiyF9LDp2t713rV6rX+0H+JvSrBzjzs1bgWCQgQweZBv2ftq2VVe+o/Dy8kBPBj63Dqg4MmFw0BvGeIIT190NVqGE+9dRoCeBPY2fxZ4KIiQBg7mxeForkNKgKEzzBD8coUHQG8q4ihdlkabZaOABFsHmpXda1KRX+pVygJ4Epge1Hv9ytGfVIChL5he1EfPLZMSgAvZlArnb8REyCIzYPabxlRE2ACPReD9kMr1ASIZLC9GAy12kN6AkSweSh3enpL9AT8vqm2RREgnEEN2ieoQgj4PJTbd3dzVAT+GiUhhqEoAriws9kURoAgthd1UQR8HmoE44gVRvZiVhwBXNbrsCiQAKGclSEGztpkXAmwY8jIr0fIMa4j4LJ9Ng/BWV8kZkqaAVt9zmV5wgdwlneNmUqGQMvJPJwGwFnjO6a/lJ0HuwV/mRZQPh4Hpx3JI4ItsJ/rcOSd0iE4z7+1y4wWtv3wjIJHJ8zoJBeEFzTxNbaQlaTsQmxm4pn6j8ldmTFpNzkfhpc1/nZH+57LtBP++dj29tj5f+l/AF/0SGi24tmhAAAAAElFTkSuQmCC" style="width: 100%;height: 100%;object-fit: cover;" height="140" width="130" alt="now-logo">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="input-group no-border form-control-lg {{ $errors->has('password') ? ' has-danger' : '' }}">
                                <span class="input-group-prepend">
                                  <div class="input-group-text">
                                    <i class="now-ui-icons users_circle-08"></i>
                                  </div>
                                </span>
                                <input id="password" type="password" placeholder="{{__('user.password')}}" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" autofocus>
                            </div>
                            @error('email')
                            <span style="display:block;" class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="card-footer ">
                            <button type="submit" class="btn btn-primary btn-round btn-lg btn-block mb-3">{{ __('Confirm') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
