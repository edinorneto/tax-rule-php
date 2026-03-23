<?php

function obter_informacoes($regime, $regiao) {
    $base = [
        'ttd xx' => [
            'interna/sc' => [
                'cfop'     => '5102 – Venda interna nacional',
                'cst'      => '7 - Importada sem similar nacional',
                'trib_icms'=> '051',
                'descricao'=> 'Exemplo fictício de diferimento. Alíquotas zero para PIS/COFINS e IPI. Consulte legislação real.',
                'icms'     => '5,0',
                'ipi'      => '0',
                'pis'      => '0',
                'cofins'   => '0'
            ],
            'externa/pr' => [
                'cfop'     => '6102 – Venda interestadual nacional',
                'cst'      => '7 - Importada sem similar nacional',
                'trib_icms'=> '051',
                'descricao'=> 'Exemplo fictício de diferimento. Alíquotas zero para PIS/COFINS e IPI. Consulte legislação real.',
                'icms'     => '5,0',
                'ipi'      => '0',
                'pis'      => '0',
                'cofins'   => '0'
            ],
            'externa/rs' => [
                'cfop'     => '6102 – Venda interestadual nacional',
                'cst'      => '7 - Importada sem similar nacional',
                'trib_icms'=> '051',
                'descricao'=> 'Exemplo fictício de diferimento. Alíquotas zero para PIS/COFINS e IPI. Consulte legislação real.',
                'icms'     => '5,0',
                'ipi'      => '0',
                'pis'      => '0',
                'cofins'   => '0'
            ],
            'externa/mt' => [
                'cfop'     => '6102 – Venda interestadual nacional',
                'cst'      => '7 - Importada sem similar nacional',
                'trib_icms'=> '051',
                'descricao'=> 'Exemplo fictício de diferimento. Alíquotas zero para PIS/COFINS e IPI. Consulte legislação real.',
                'icms'     => '5,0',
                'ipi'      => '0',
                'pis'      => '0',
                'cofins'   => '0'
            ],
            'externa/ms' => [
                'cfop'     => '6102 – Venda interestadual nacional',
                'cst'      => '7 - Importada sem similar nacional',
                'trib_icms'=> '051',
                'descricao'=> 'Exemplo fictício de diferimento. Alíquotas zero para PIS/COFINS e IPI. Consulte legislação real.',
                'icms'     => '5,0',
                'ipi'      => '0',
                'pis'      => '0',
                'cofins'   => '0'
            ]
        ],
        'convenio xx' => [
            'interna/sc' => [
                'cfop'     => '5102 – Venda interna nacional',
                'cst'      => '7 - Importada sem similar nacional',
                'trib_icms'=> '040',
                'descricao'=> 'Exemplo fictício de isenção. Alíquotas zero para PIS/COFINS e IPI. Consulte legislação real.',
                'icms'     => '0',
                'ipi'      => '0',
                'pis'      => '0',
                'cofins'   => '0'
            ],
            'externa/pr' => [
                'cfop'     => '6102 – Venda interestadual nacional',
                'cst'      => '7 - Importada sem similar nacional',
                'trib_icms'=> '020',
                'descricao'=> 'Exemplo fictício de redução de base. Alíquotas zero para PIS/COFINS e IPI. Consulte legislação real.',
                'icms'     => '6,0',
                'ipi'      => '0',
                'pis'      => '0',
                'cofins'   => '0'
            ],
            'externa/rs' => [
                'cfop'     => '6102 – Venda interestadual nacional',
                'cst'      => '7 - Importada sem similar nacional',
                'trib_icms'=> '020',
                'descricao'=> 'Exemplo fictício de redução de base. Alíquotas zero para PIS/COFINS e IPI. Consulte legislação real.',
                'icms'     => '6,0',
                'ipi'      => '0',
                'pis'      => '0',
                'cofins'   => '0'
            ],
            'externa/mt' => [
                'cfop'     => '6102 – Venda interestadual nacional',
                'cst'      => '7 - Importada sem similar nacional',
                'trib_icms'=> '020',
                'descricao'=> 'Exemplo fictício de redução de base. Alíquotas zero para PIS/COFINS e IPI. Consulte legislação real.',
                'icms'     => '6,0',
                'ipi'      => '0',
                'pis'      => '0',
                'cofins'   => '0'
            ],
            'externa/ms' => [
                'cfop'     => '6102 – Venda interestadual nacional',
                'cst'      => '7 - Importada sem similar nacional',
                'trib_icms'=> '020',
                'descricao'=> 'Exemplo fictício de redução de base. Alíquotas zero para PIS/COFINS e IPI. Consulte legislação real.',
                'icms'     => '6,0',
                'ipi'      => '0',
                'pis'      => '0',
                'cofins'   => '0'
            ]
        ]
    ];

    if (isset($base[$regime][$regiao])) {
        return $base[$regime][$regiao];
    }

    return [
        'descricao' => 'Combinação de regime/região não encontrada (exemplo fictício).',
        'icms'      => '-',
        'ipi'       => '-',
        'pis'       => '-',
        'cofins'    => '-'
    ];
}

?>