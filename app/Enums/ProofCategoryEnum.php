<?php

namespace App\Enums;

enum ProofCategoryEnum: string
{
    case IdentityProof = 'Identity Proof';
    case AddressProof = 'Address Proof';
    case IdentityAddressProof = 'Identity Address Proof';
}
