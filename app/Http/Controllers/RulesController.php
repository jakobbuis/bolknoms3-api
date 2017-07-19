<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RulesController extends Controller
{
    public function index()
    {
        return [
            'data' => [
                [
                    'title' => 'Aanmelden',
                    'rules' => [
                        'Je kunt niet mee-eten zonder je aan te melden.',
                        'Je kunt je aanmelden tot de vastgestelde sluitingstijd (meestal 15:00 uur). De sluitingstijd wordt bepaald door het bestuur en staat vermeld bij de maaltijd.',
                        'Bolkers kunnen zich aanmelden voor alle open maaltijden. Ze hoeven hun aanmelding niet te bevestigen via e-mail.',
                        'Externen kunnen zich aanmelden voor de eerstvolgende maaltijd, en in sommige gevallen ook voor latere maaltijden. Na aanmelden krijg je een e-mail met een bevestigingslink. Als je je aanmelding niet bevestigt door voor 15:00 uur op die link te klikken, kun je niet mee-eten.',
                        'Je kunt je weer afmelden tot aan de sluitingstijd. Als je met je Bolkaccount aangemeld bent, doe je dat via de website. Als je geen Bolkaccount hebt, meld je je af door het bestuur te bellen op 015 212 60 12',
                    ]
                ],
                [
                    'title' => 'Mee-eten',
                    'rules' => [
                        'De maaltijd begint om 18:30 uur. Het kan zijn dat bij uitzondering de maaltijd op een ander moment begint; dat wordt vermeld bij de maaltijd.',
                        'Als je te laat komt, loop je het risico dat er geen eten meer voor je is. Je moet in dat geval wel voor de maaltijd betalen.',
                    ]
                ],
                [
                    'title' => 'Betalen',
                    'rules' => [
                        'Je betaalt de maaltijd met een bonnetje. Die kun je kopen in de sociëteit.',
                        'Als je niet op tijd afmeldt en niet komt opdagen, moet je wel voor de maaltijd betalen (meestal &euro;3,50). Er is immers wel voor je gekookt. Voor leden gaat dat op Bolkrekening, externen krijgen een factuur gemaild.',
                    ]
                ],
            ]
        ];
    }
}
