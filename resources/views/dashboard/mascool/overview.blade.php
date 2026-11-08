@extends('dashboard.mascool.layouts.app')
@section('title', 'نظرة عامة')

@push('styles')
    <style>
        .overview-hero{margin-bottom:18px}
        .overview-status{display:none}
        .overview-actions{display:flex;gap:8px;flex-wrap:wrap}
        .overview-stats{margin-bottom:18px}
        .overview-stat{position:relative;overflow:hidden}
        .overview-stat:hover{border-color:#cadbe1;background:#fbfdfd}
        .overview-panels{align-items:start}
        .overview-card{overflow:hidden}
        .recent-list{padding-block:6px}
        .equipment-row{display:flex;align-items:center;gap:12px;padding:9px 0;border-bottom:1px solid var(--line-soft)}
        .equipment-row:last-child{border-bottom:0}
        .equipment-row__copy{flex:1;min-width:0}
        .equipment-row__name{font-size:13.5px;font-weight:700;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
        .equipment-row__meta{font-size:11.5px;color:var(--muted);white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
        .distribution-row{margin-bottom:12px}
        .distribution-row:last-of-type{margin-bottom:0}
        .distribution-row__head{display:flex;justify-content:space-between;font-size:13px;font-weight:700;margin-bottom:5px}
        .distribution-row__track{height:9px;border-radius:var(--r-pill);background:var(--ice);overflow:hidden}
        .distribution-row__bar{height:100%;background:var(--navy);border-radius:var(--r-pill)}
        .overview-whatsapp{margin-top:12px;font-size:12.5px;color:var(--muted)}

        @media(max-width:640px){
            .topbar{gap:8px;padding-inline:12px}
            .topbar__titles{display:none}
            .topbar__actions{margin-inline-start:auto}
            .topbar__actions>.btn{width:44px;padding:0;font-size:0}
            .topbar__actions>.btn svg{width:18px;height:18px}
            .account__btn{width:44px;padding:0;justify-content:center}
            .account__btn>span:last-child{display:none}
            .content{padding:12px}

            .overview-hero{
                position:relative;display:block;overflow:hidden;padding:17px;margin-bottom:12px;
                border-radius:20px;background:linear-gradient(145deg,var(--navy-mid),var(--navy-deep));
                box-shadow:0 14px 32px rgba(3,29,39,.16);color:#fff
            }
            .overview-hero:after{
                content:"";position:absolute;width:150px;height:150px;border:34px solid rgba(212,248,63,.07);
                border-radius:50%;inset-inline-end:-80px;bottom:-100px;pointer-events:none
            }
            .overview-status{position:relative;z-index:1;display:inline-flex;align-items:center;gap:7px;font-size:10.5px;font-weight:700;color:#dbe8ec;margin-bottom:7px}
            .overview-status i{width:7px;height:7px;border-radius:50%;background:var(--lime);box-shadow:0 0 0 4px rgba(212,248,63,.12)}
            .overview-hero .page-head__text{position:relative;z-index:1}
            .overview-hero h1{font-size:22px;color:#fff;letter-spacing:-.4px}
            .overview-hero p{font-size:12px;color:#b8cbd1;margin-top:2px}
            .overview-actions{position:relative;z-index:1;display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:8px;margin-top:14px}
            .overview-actions .btn{width:100%;min-height:42px;padding:8px 9px;font-size:12.5px}
            .overview-actions .btn:first-child{grid-column:1/-1}
            .overview-actions .btn--dark{background:rgba(255,255,255,.09);border-color:rgba(255,255,255,.16);color:#fff}
            .overview-actions .btn--outline{background:#fff;color:var(--navy);border-color:#fff}

            .overview-stats{grid-template-columns:repeat(4,minmax(0,1fr));gap:7px;margin-bottom:12px!important}
            .overview-stat{min-height:68px;padding:6px 5px;border-radius:12px;box-shadow:none;display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center}
            .overview-stat:after{content:"";position:absolute;inset-inline-start:0;top:0;width:2px;height:100%;background:var(--lime)}
            .overview-stat:nth-child(even):after{background:var(--navy-mid)}
            .overview-stat .stat__label{font-size:9.5px;gap:4px;justify-content:center;line-height:1.4;white-space:nowrap}
            .overview-stat .stat__label .ic{width:13px;height:13px}
            .overview-stat .stat__value{font-size:21px;line-height:1.1;margin-top:4px}
            .overview-stat .stat__value span{font-size:12px!important}
            .overview-stat .stat__value--ratio{direction:ltr}

            .overview-panels{grid-template-columns:1fr;gap:12px}
            .overview-card{border-radius:18px;box-shadow:none}
            .overview-card .card__head{padding:12px 14px}
            .overview-card .card__head h2{font-size:15px}
            .overview-card .card__head p{font-size:10.5px}
            .overview-card .card__body{padding:8px 13px 12px}
            .recent-list{padding-block:2px!important}
            .equipment-row{gap:9px;padding:8px 0}
            .equipment-row:nth-child(n+5){display:none}
            .equipment-row .thumb{width:54px;height:40px}
            .equipment-row__name{font-size:12.5px}
            .equipment-row__meta{font-size:10px}
            .equipment-row .btn{min-height:34px;padding:4px 10px;font-size:11.5px}
            .distribution-row{margin-bottom:10px}
            .distribution-row__head{font-size:11.5px;margin-bottom:4px}
            .distribution-row__track{height:7px}
            .overview-whatsapp{margin-top:10px;font-size:11px;text-align:center}
        }

        @media(max-width:370px){
            .overview-stats{gap:5px}
            .overview-stat{min-height:64px;padding:5px 3px}
            .overview-stat .stat__label{font-size:8.5px;gap:3px}
            .overview-stat .stat__label .ic{width:12px;height:12px}
            .overview-actions .btn{font-size:11.5px}
        }
    </style>
@endpush

@section('content')
    @php use App\Support\HomeMedia; @endphp

    <div class="page-head overview-hero">
        <div class="page-head__text">
            <span class="overview-status"><i aria-hidden="true"></i> الموقع متصل وجاهز للإدارة</span>
            <h1>نظرة عامة</h1>
            <p>تابع محتوى الصفحة الرئيسية ومعدات mas Cool من مكان واحد.</p>
        </div>
        <div class="overview-actions">
            <a class="btn btn--primary" href="{{ route('admin.home.editor') }}">محرر الصفحة الرئيسية</a>
            <a class="btn btn--dark" href="{{ route('admin.equipment.products.create') }}">إضافة معدة</a>
            <a class="btn btn--outline" href="{{ route('landing') }}" target="_blank" rel="noopener">معاينة الموقع</a>
        </div>
    </div>

    <div class="grid grid--stats overview-stats">
        <a class="stat overview-stat" href="{{ route('admin.equipment.categories.index') }}" aria-label="إدارة التصنيفات">
            <span class="stat__label"><svg class="ic" aria-hidden="true"><use href="#i-layers"/></svg> التصنيفات</span>
            <div class="stat__value">{{ $stats['categories'] }}</div>
        </a>
        <a class="stat overview-stat" href="{{ route('admin.equipment.products.index') }}" aria-label="إدارة المعدات">
            <span class="stat__label"><svg class="ic" aria-hidden="true"><use href="#i-box"/></svg> المعدات</span>
            <div class="stat__value">{{ $stats['products'] }}</div>
        </a>
        <a class="stat overview-stat" href="{{ route('admin.equipment.products.index') }}" aria-label="المعدات المتاحة للمعاينة">
            <span class="stat__label"><svg class="ic" aria-hidden="true"><use href="#i-check"/></svg> المعاينة</span>
            <div class="stat__value">{{ $stats['available'] }}</div>
        </a>
        <a class="stat overview-stat" href="{{ route('admin.home.editor') }}" aria-label="إدارة أقسام الصفحة الرئيسية">
            <span class="stat__label"><svg class="ic" aria-hidden="true"><use href="#i-spark"/></svg> الأقسام</span>
            <div class="stat__value stat__value--ratio">{{ $stats['sections'] }}<span style="font-size:16px;color:var(--muted-soft)">/{{ $stats['sectionsTotal'] }}</span></div>
        </a>
    </div>

    <div class="grid grid--2 overview-panels">
        <section class="card overview-card">
            <div class="card__head">
                <div><h2>آخر تحديثات المعدات</h2><p>أحدث العناصر التي تم تعديلها</p></div>
                <a class="btn btn--outline btn--sm" href="{{ route('admin.equipment.products.index') }}">عرض الكل</a>
            </div>
            <div class="card__body recent-list">
                @forelse($recent as $product)
                    <div class="equipment-row">
                        <img class="thumb" src="{{ HomeMedia::url($product->image) }}" alt="{{ $product->image_alt }}" loading="lazy">
                        <div class="equipment-row__copy">
                            <div class="equipment-row__name">{{ $product->name }}</div>
                            <div class="equipment-row__meta">{{ $product->category?->name }} · {{ $product->updated_at?->locale('ar')->diffForHumans() }}</div>
                        </div>
                        <a class="btn btn--outline btn--sm" href="{{ route('admin.equipment.products.edit', $product) }}">تعديل</a>
                    </div>
                @empty
                    <div class="empty"><h3>لا توجد معدات</h3><p>ابدأ بإضافة أول معدة.</p>
                        <a class="btn btn--primary" href="{{ route('admin.equipment.products.create') }}">إضافة معدة</a></div>
                @endforelse
            </div>
        </section>

        <section class="card overview-card">
            <div class="card__head"><div><h2>توزيع المعدات حسب التصنيف</h2><p>المعدات النشطة</p></div></div>
            <div class="card__body">
                @php $total = max(1, $byCategory->sum('products_count')); @endphp
                @forelse($byCategory as $category)
                    <div class="distribution-row">
                        <div class="distribution-row__head"><span>{{ $category->name }}</span><span>{{ $category->products_count }}</span></div>
                        <div class="distribution-row__track">
                            <div class="distribution-row__bar" style="width:{{ round($category->products_count / $total * 100) }}%"></div>
                        </div>
                    </div>
                @empty
                    <div class="empty"><p>لا توجد تصنيفات بعد.</p></div>
                @endforelse
                <p class="overview-whatsapp">تفاعلات واتساب خلال 30 يومًا: <strong>{{ $stats['whatsapp30'] }}</strong></p>
            </div>
        </section>
    </div>
@endsection
