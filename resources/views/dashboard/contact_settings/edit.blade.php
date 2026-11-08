@extends('dashboard.mascool.layouts.app')

@section('title', 'التواصل وواتساب')

@push('styles')
    <style>
        .topbar__crumb{display:none}
        .topbar__title{font-size:21px}
        .contact-workspace{display:grid;grid-template-columns:minmax(300px,.72fr) minmax(0,1.55fr);gap:14px;align-items:stretch}
        .contact-workspace__main{display:grid;gap:14px;min-width:0}
        .contact-card{overflow:hidden}
        .contact-card__title{display:flex;align-items:center;gap:10px}
        .contact-card__icon{width:38px;height:38px;border-radius:10px;display:grid;place-items:center;color:var(--navy);background:var(--lime-soft);flex:none}
        .contact-card__icon svg{width:19px;height:19px;fill:none;stroke:currentColor;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round}
        .contact-card .card__head{align-items:flex-start;padding:12px 16px}
        .contact-card .card__body{padding:15px 16px}
        .contact-fields{grid-template-columns:repeat(2,minmax(0,1fr))}
        .social-grid{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:12px}
        .social-card>summary{list-style:none;cursor:pointer;user-select:none}
        .social-card>summary::-webkit-details-marker{display:none}
        .social-card>summary:after{content:"＋";width:30px;height:30px;border-radius:9px;background:var(--ice);display:grid;place-items:center;font-size:18px;font-weight:700;flex:none}
        .social-card[open]>summary:after{content:"−"}

        .whatsapp-panel{position:sticky;top:calc(var(--header-h) + 20px);height:100%;overflow:hidden;background:var(--navy);border-color:var(--navy);color:#fff;box-shadow:var(--shadow);display:flex;flex-direction:column}
        .whatsapp-panel__hero{padding:18px 20px 15px;background:linear-gradient(145deg,var(--navy-mid),var(--navy-deep))}
        .whatsapp-panel__mark{width:42px;height:42px;border-radius:12px;display:grid;place-items:center;margin-bottom:12px;background:var(--lime);color:var(--navy)}
        .whatsapp-panel__mark svg{width:25px;height:25px;fill:none;stroke:currentColor;stroke-width:1.9;stroke-linecap:round;stroke-linejoin:round}
        .whatsapp-panel h2{font-size:20px;line-height:1.45;font-weight:800}
        .whatsapp-panel__hero p{font-size:13px;color:#b8cbd1;margin-top:6px;line-height:1.8}
        .whatsapp-panel__body{padding:16px 20px 18px;display:flex;flex:1;flex-direction:column}
        .whatsapp-panel .field label{color:#fff}
        .whatsapp-panel .field input{background:#fff;border-color:transparent;font-size:16px;font-weight:700;letter-spacing:.02em}
        .whatsapp-panel .field .hint{color:#9fb5bd;line-height:1.8}
        .whatsapp-panel__status{display:flex;align-items:center;gap:8px;margin:auto 0 18px;padding:11px 12px;border:1px solid rgba(255,255,255,.12);border-radius:var(--r-sm);background:rgba(255,255,255,.055);color:#dbe7ea;font-size:12.5px}
        .whatsapp-panel__status i{width:8px;height:8px;border-radius:50%;background:var(--lime);box-shadow:0 0 0 4px rgba(212,248,63,.12);flex:none}
        .whatsapp-panel__test{width:100%;background:var(--lime);color:var(--navy);border-color:var(--lime)}
        .whatsapp-panel__test:hover{background:var(--lime-hover)}
        .whatsapp-panel__test.is-disabled{opacity:.45;pointer-events:none}

        .contact-actions{display:flex;align-items:center;justify-content:space-between;gap:14px;margin-top:14px;padding:10px 14px;border:1px solid var(--line);border-radius:var(--r-md);background:#fff;box-shadow:var(--shadow-sm)}
        .contact-actions__note{font-size:12.5px;color:var(--muted)}
        .contact-actions__buttons{display:flex;gap:10px;flex-wrap:wrap;flex:none}

        @media(max-width:1500px){
            .social-grid{grid-template-columns:repeat(2,minmax(0,1fr))}
        }
        @media(max-width:1180px){
            .contact-workspace{grid-template-columns:minmax(280px,.85fr) minmax(0,1.35fr)}
            .contact-fields{grid-template-columns:1fr}
        }
        @media(max-width:820px){
            .contact-workspace{grid-template-columns:1fr}
            .whatsapp-panel{position:static;grid-row:1;height:auto}
            .contact-fields,.social-grid{grid-template-columns:repeat(2,minmax(0,1fr))}
            .whatsapp-panel__status{margin:16px 0 18px}
        }
        @media(max-width:640px){
            .topbar{gap:8px;padding-inline:12px}
            .topbar__title{font-size:16px}
            .topbar__actions>.btn{width:44px;padding:0;font-size:0}
            .topbar__actions>.btn svg{width:18px;height:18px}
            .account__btn{width:44px;padding:0;justify-content:center}
            .account__btn>span:last-child{display:none}
            .content{padding:12px}
            .contact-workspace,.contact-workspace__main{gap:12px}
            .contact-fields,.social-grid{grid-template-columns:repeat(2,minmax(0,1fr));gap:12px}
            .contact-card .card__head{align-items:center;padding:11px 12px}
            .contact-card .card__head p{display:none}
            .contact-card .card__body{padding:13px}
            .contact-card__icon{width:34px;height:34px;border-radius:9px}
            .contact-card__title{gap:8px}
            .contact-card__title h2{font-size:14.5px}
            .contact-card .badge{padding:2px 8px;font-size:10.5px}
            .field label{font-size:12px;margin-bottom:4px}
            .field input[type=text],.field input[type=email],.field input[type=url]{min-height:44px;padding:8px 10px;font-size:13px}
            .whatsapp-panel__hero{display:grid;grid-template-columns:42px minmax(0,1fr);column-gap:12px;padding:15px 16px}
            .whatsapp-panel__mark{grid-row:1/3;width:42px;height:42px;margin:0}
            .whatsapp-panel h2{font-size:17px;align-self:end}
            .whatsapp-panel__hero p{font-size:11.5px;line-height:1.65;margin-top:2px}
            .whatsapp-panel__body{padding:13px 16px 15px}
            .whatsapp-panel .field input{font-size:14px}
            .whatsapp-panel .field .hint{font-size:10.5px;line-height:1.65}
            .whatsapp-panel__status{display:none}
            .whatsapp-panel__test{min-height:42px;margin-top:10px}
            .contact-actions{align-items:stretch;flex-direction:column}
            .contact-actions__note{display:none}
            .contact-actions__buttons{width:100%}
            .contact-actions__buttons .btn{flex:1}
        }
        @media(max-width:400px){
            .contact-fields,.social-grid{grid-template-columns:1fr}
            .topbar__actions>.btn{display:none}
            .contact-card .badge{display:none}
        }
    </style>
@endpush

@section('content')
    @php
        $whatsappValue = old('whatsapp_number', $setting->whatsapp_number);
        $whatsappDigits = preg_replace('/\D+/', '', (string) $whatsappValue);
    @endphp

    @if(session('success'))
        <div class="flash flash--ok" role="status">تم حفظ إعدادات التواصل بنجاح.</div>
    @endif

    @if($errors->any())
        <div class="flash flash--err" role="alert">توجد بيانات تحتاج إلى مراجعة. صحّح الحقول الموضحة ثم حاول الحفظ مرة أخرى.</div>
    @endif

    <form action="{{ route('admin.contact-settings.update') }}" method="post">
        @csrf
        @method('PUT')

        <div class="contact-workspace">
            <aside class="card whatsapp-panel" aria-labelledby="whatsapp-heading">
                <div class="whatsapp-panel__hero">
                    <span class="whatsapp-panel__mark" aria-hidden="true">
                        <svg viewBox="0 0 24 24"><path d="M20 11.5a8 8 0 0 1-11.8 7L4 20l1.5-4.1A8 8 0 1 1 20 11.5Z"/><path d="M9 8.5c.4 2.4 2.1 4.1 4.5 4.5"/><path d="m8.8 8.2.8-.7M13.5 13l.7-.8"/></svg>
                    </span>
                    <h2 id="whatsapp-heading">واتساب الاستفسارات</h2>
                    <p>هذا الرقم مرتبط بجميع أزرار واتساب وطلبات الأسعار داخل الموقع.</p>
                </div>
                <div class="whatsapp-panel__body">
                    <div class="field">
                        <label for="whatsapp_number">رقم واتساب</label>
                        <input class="@error('whatsapp_number') is-invalid @enderror" id="whatsapp_number" name="whatsapp_number" type="text"
                               value="{{ $whatsappValue }}" dir="ltr" inputmode="tel" maxlength="30" placeholder="+201001234567">
                        <p class="hint">اكتبه بصيغة دولية مع كود الدولة، بدون رابط واتساب.</p>
                        @error('whatsapp_number')<span class="error">{{ $message }}</span>@enderror
                    </div>
                    <div class="whatsapp-panel__status">
                        <i aria-hidden="true"></i>
                        <span>أي تغيير لن يظهر على الموقع إلا بعد الضغط على «حفظ التغييرات».</span>
                    </div>
                    <a class="btn whatsapp-panel__test{{ $whatsappDigits ? '' : ' is-disabled' }}"
                       href="{{ $whatsappDigits ? 'https://wa.me/'.$whatsappDigits : '#' }}" target="_blank" rel="noopener noreferrer">
                        اختبار الرقم على واتساب
                    </a>
                </div>
            </aside>

            <div class="contact-workspace__main">
                <section class="card contact-card" aria-labelledby="contact-details-heading">
                    <div class="card__head">
                        <div class="contact-card__title">
                            <span class="contact-card__icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24"><path d="M4 5.5h16v13H4z"/><path d="m5 7 7 5 7-5"/></svg>
                            </span>
                            <div>
                                <h2 id="contact-details-heading">بيانات الاتصال الأساسية</h2>
                                <p>البيانات الرسمية التي تظهر للعميل في الموقع.</p>
                            </div>
                        </div>
                        <span class="badge badge--on">متصل بالموقع</span>
                    </div>
                    <div class="card__body">
                        <div class="form-grid contact-fields">
                            <div class="field">
                                <label for="email">البريد الإلكتروني</label>
                                <input class="@error('email') is-invalid @enderror" id="email" name="email" type="email"
                                       value="{{ old('email', $setting->email) }}" dir="ltr" placeholder="info@example.com">
                                @error('email')<span class="error">{{ $message }}</span>@enderror
                            </div>
                            <div class="field">
                                <label for="phone">رقم الهاتف</label>
                                <input class="@error('phone') is-invalid @enderror" id="phone" name="phone" type="text"
                                       value="{{ old('phone', $setting->phone) }}" dir="ltr" inputmode="tel" placeholder="+201001234567">
                                @error('phone')<span class="error">{{ $message }}</span>@enderror
                            </div>
                            <div class="field">
                                <label for="address">العنوان</label>
                                <input class="@error('address') is-invalid @enderror" id="address" name="address" type="text"
                                       value="{{ old('address', $setting->address) }}" placeholder="عنوان المعرض أو المخزن">
                                @error('address')<span class="error">{{ $message }}</span>@enderror
                            </div>
                            <div class="field">
                                <label for="map_url">رابط الموقع على الخريطة</label>
                                <input class="@error('map_url') is-invalid @enderror" id="map_url" name="map_url" type="url"
                                       value="{{ old('map_url', $setting->map_url) }}" dir="ltr" placeholder="https://maps.google.com/…">
                                @error('map_url')<span class="error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
                </section>

                <details class="card contact-card social-card" data-social-card open aria-labelledby="social-heading">
                    <summary class="card__head">
                        <div class="contact-card__title">
                            <span class="contact-card__icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24"><circle cx="6" cy="12" r="2.5"/><circle cx="18" cy="6" r="2.5"/><circle cx="18" cy="18" r="2.5"/><path d="m8.2 10.8 7.5-3.6M8.2 13.2l7.5 3.6"/></svg>
                            </span>
                            <div>
                                <h2 id="social-heading">روابط التواصل الاجتماعي</h2>
                                <p>اترك أي منصة فارغة إذا كنت لا تريد إظهارها.</p>
                            </div>
                        </div>
                    </summary>
                    <div class="card__body">
                        <div class="social-grid">
                            @foreach(['facebook' => 'Facebook','instagram' => 'Instagram','twitter' => 'X / Twitter','linkedin' => 'LinkedIn'] as $field => $label)
                                <div class="field">
                                    <label for="{{ $field }}">{{ $label }}</label>
                                    <input class="@error($field) is-invalid @enderror" id="{{ $field }}" name="{{ $field }}" type="url"
                                           value="{{ old($field, $setting->{$field}) }}" dir="ltr" placeholder="https://">
                                    @error($field)<span class="error">{{ $message }}</span>@enderror
                                </div>
                            @endforeach
                        </div>
                    </div>
                </details>
            </div>
        </div>

        <div class="contact-actions">
            <p class="contact-actions__note">راجع البيانات ثم احفظها لتحديث الموقع مباشرة.</p>
            <div class="contact-actions__buttons">
                <a class="btn btn--outline" href="{{ route('landing') }}" target="_blank" rel="noopener">فتح الموقع</a>
                <button class="btn btn--primary" type="submit">حفظ التغييرات</button>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        (function () {
            const socialCard = document.querySelector('[data-social-card]');
            if (!socialCard) return;

            const mobile = window.matchMedia('(max-width: 640px)');
            const hasSocialError = @json(
                $errors->has('facebook') ||
                $errors->has('instagram') ||
                $errors->has('twitter') ||
                $errors->has('linkedin')
            );

            const syncSocialCard = (event) => {
                socialCard.open = !event.matches || hasSocialError;
            };

            syncSocialCard(mobile);
            mobile.addEventListener?.('change', syncSocialCard);
        })();
    </script>
@endpush
