<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CulturalHeritage;
use App\Models\CulturalInstitutions;
use App\Models\IntangibleCulturalHeritage;
use App\Models\SignificantPersonalities;
use App\Models\TangibleImmovableCulturalHeritage;
use App\Models\TangibleMovableCulturalHeritage;

class VisitorMapping extends Controller
{
    public function index()
    {

        $heritages = CulturalHeritage::all();
        $tangible_immovable = TangibleImmovableCulturalHeritage::all();
        $significant_personalities = SignificantPersonalities::all();
        $tangible_movable = TangibleMovableCulturalHeritage::all();
        $intangible = IntangibleCulturalHeritage::all();
        $cultural_institutions = CulturalInstitutions::all();

        return view('livewire.visitor.visitor-mapping', [
            'heritages' => $heritages,
            'tangible_immovable' => $tangible_immovable,
            'significant_personalities' => $significant_personalities,
            'tangible_movable' => $tangible_movable,
            'intangible' => $intangible,
            'cultural_institutions' => $cultural_institutions
        ]);
    }

    public function snr()
    {
        $groupedHeritages = CulturalHeritage::all()->groupBy('cultural_heritage_type');

        return view('livewire.admin.visitor-mapping.snr', ['groupedHeritages' => $groupedHeritages]);
    }

    public function immovable()
    {
        $groupedHeritages = TangibleImmovableCulturalHeritage::all()->groupBy('cultural_heritage_type');

        return view('livewire.admin.visitor-mapping.immovable', ['groupedHeritages' => $groupedHeritages]);
    }

    public function movable()
    {
        $groupedHeritages = TangibleMovableCulturalHeritage::all()->groupBy('cultural_heritage_type');

        return view('livewire.admin.visitor-mapping.movable', ['groupedHeritages' => $groupedHeritages]);
    }

    public function intangible()
    {
        $groupedHeritages = IntangibleCulturalHeritage::all()->groupBy('cultural_heritage_type');

        return view('livewire.admin.visitor-mapping.intangible', ['groupedHeritages' => $groupedHeritages]);
    }

    public function significantPersonalities()
    {
        $groupedHeritages = IntangibleCulturalHeritage::all();

        return view('livewire.admin.visitor-mapping.significant-personalities', ['groupedHeritages' => $groupedHeritages]);
    }

    public function culturalIntitutions()
    {
        $groupedHeritages = CulturalInstitutions::all()->groupBy('cultural_heritage_type');

        return view('livewire.admin.visitor-mapping.cultural', ['groupedHeritages' => $groupedHeritages]);
    }

    // ======================================================================> types
    //SNR
    // public function show($id)
    // {
    //     $heritage = CulturalHeritage::findOrFail($id);

    //     if ($heritage->cultural_heritage_type !== 'Plants (Flora)') {
    //         abort(404);
    //     }

    //     return view('livewire.admin.visitor-mapping.mapping-details.snr-data',['heritage' => $heritage]);
    // }

    public function showBodiesOfWater($id)
    {

        $bow = CulturalHeritage::find($id);

        $bow->increment('views');

        if ($bow->cultural_heritage_type !== 'Bodies of Water') {

            abort(404);
        }

        return view('livewire.admin.visitor-mapping.mapping-details.bodies-of-water', [
            'bow' => $bow
        ]);
    }

    public function showFauna($id)
    {
        $plants = CulturalHeritage::findOrFail($id);

        $plants->increment('views');

        if ($plants->cultural_heritage_type !== 'Plants (Flora)') {
            abort(404);
        }

        return view('livewire.admin.visitor-mapping.mapping-details.plants', compact('plants'));
    }

    public function showAnimal($id)
    {
        $animal = CulturalHeritage::findOrFail($id);

        $animal->increment('views');

        if ($animal->cultural_heritage_type !== 'Animals (Fauna)') {
            abort(404);
        }


        return view('livewire.admin.visitor-mapping.mapping-details.animal', compact('animal'));
    }

    public function showCritical($id)
    {
        $critical = CulturalHeritage::findOrFail($id);

        $critical->increment('views');

        if ($critical->cultural_heritage_type !== 'Critical Area') {
            abort(404);
        }

        return view('livewire.admin.visitor-mapping.mapping-details.critical', compact('critical'));
    }

    public function showProtected($id)
    {
        $protected = CulturalHeritage::findOrFail($id);

        $protected->increment('views');

        if ($protected->cultural_heritage_type !== 'Protected Area') {
            abort(404);
        }

        return view('livewire.admin.visitor-mapping.mapping-details.protected', compact('protected'));
    }


    // IMMOVABLE

    public function showGovernment($id)
    {
        $gov = TangibleImmovableCulturalHeritage::findOrFail($id);

        $gov->increment('views');

        if ($gov->cultural_heritage_type !== 'Government/Private') {
            abort(404);
        }

        return view('livewire.admin.visitor-mapping.mapping-details.government', compact('gov'));
    }

    public function showSites($id)
    {
        $sites = TangibleImmovableCulturalHeritage::findOrFail($id);

        $sites->increment('views');

        if ($sites->cultural_heritage_type !== 'Sites') {
            abort(404);
        }

        return view('livewire.admin.visitor-mapping.mapping-details.sites', compact('sites'));
    }

    public function showHouse($id)
    {
        $house = TangibleImmovableCulturalHeritage::findOrFail($id);

        $house->increment('views');

        if ($house->cultural_heritage_type !== 'House') {
            abort(404);
        }

        return view('livewire.admin.visitor-mapping.mapping-details.house', compact('house'));
    }


    // MOVABLE

    public function showEthnographic($id)
    {
        $ethno = TangibleMovableCulturalHeritage::findOrFail($id);

        $ethno->increment('views');

        if ($ethno->cultural_heritage_type !== 'Ethnographic Object') {
            abort(404);
        }

        return view('livewire.admin.visitor-mapping.mapping-details.ethnographic', compact('ethno'));
    }

    public function showArchival($id)
    {
        $arch = TangibleMovableCulturalHeritage::findOrFail($id);

        $arch->increment('views');

        if ($arch->cultural_heritage_type !== 'Archival Holdings') {
            abort(404);
        }

        return view('livewire.admin.visitor-mapping.mapping-details.archival', compact('arch'));
    }


    // INTANGIBLE
    public function showSocialPractices($id)
    {
        $social = IntangibleCulturalHeritage::findOrFail($id);

        $social->increment('views');

        if ($social->cultural_heritage_type !== 'Social Practices') {
            abort(404);
        }

        return view('livewire.admin.visitor-mapping.mapping-details.social-practices', compact('social'));
    }

    public function showKnowledgePrac($id)
    {
        $kp = IntangibleCulturalHeritage::findOrFail($id);

        $kp->increment('views');

        if ($kp->cultural_heritage_type !== 'Knowledge and Practices') {
            abort(404);
        }

        return view('livewire.admin.visitor-mapping.mapping-details.knowledge-and-practices', compact('kp'));
    }

    public function showTraditionalCraftsmanship($id)
    {
        $tc = IntangibleCulturalHeritage::findOrFail($id);

        $tc->increment('views');

        if ($tc->cultural_heritage_type !== 'Traditional Craftsmanship') {
            abort(404);
        }

        return view('livewire.admin.visitor-mapping.mapping-details.traditional-craftsmanship', compact('tc'));
    }

    public function showOralTradition($id)
    {
        $oral = IntangibleCulturalHeritage::findOrFail($id);

        $oral->increment('views');

        if ($oral->cultural_heritage_type !== 'Oral Tradition') {
            abort(404);
        }

        return view('livewire.admin.visitor-mapping.mapping-details.oral-tradition', compact('oral'));
    }

    // SIGNIFICANT PERSONALITIES
    public function showSignificantPersonalities($id)
    {
        $sp = SignificantPersonalities::findOrFail($id);

        $sp->increment('views');

        return view('livewire.admin.visitor-mapping.mapping-details.personalities', compact('sp'));
    }

    // CULTURAL INSTITUTIONS
    public function showCulturalIns($id)
    {
        $assoc = CulturalInstitutions::findOrFail($id);

        $assoc->increment('views');


        return view('livewire.admin.visitor-mapping.mapping-details.association', compact('assoc'));
    }
}
