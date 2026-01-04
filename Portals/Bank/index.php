import hashlib, json, time, random
from dataclasses import dataclass, asdict
from typing import List

TARGET_ADDRESS = "bc1qnkz7e8vwkqkyx5ppf85ppc0l240zr407x8xmsz4"

# --- Helpers -----------------------------------------------------------------

def sha256(data: bytes) -> str:
    return hashlib.sha256(data).hexdigest()

def merkle_root(tx_list: List[dict]) -> str:
    """Compute a simple Merkle root from a list of tx dicts."""
    if not tx_list:
        return sha256(b"")
    level = [sha256(json.dumps(tx, sort_keys=True).encode()) for tx in tx_list]
    while len(level) > 1:
        # If odd number of hashes, duplicate last (Bitcoin style)
        if len(level) % 2 == 1:
            level.append(level[-1])
        level = [sha256((level[i] + level[i+1]).encode()) for i in range(0, len(level), 2)]
    return level[0]

# --- Data structures ---------------------------------------------------------

@dataclass
class Block:
    index: int
    timestamp: float
    previous_hash: str
    nonce: int
    difficulty: int
    transactions: List[dict]
    merkle_root: str

    def header(self) -> str:
        head = {
            "index": self.index,
            "timestamp": self.timestamp,
            "previous_hash": self.previous_hash,
            "nonce": self.nonce,
            "difficulty": self.difficulty,
            "merkle_root": self.merkle_root,
        }
        return json.dumps(head, sort_keys=True)

    def hash(self) -> str:
        return sha256(self.header().encode())

# --- MY Blockchain --------------------------------------------------------------

class TinyChain:
    def __init__(self, difficulty: int = 2):
        """
        difficulty: number of leading hex zeros required in the block hash.
        Keep this low so mining is fast on a laptop.
        """
        self.difficulty = difficulty
        self.chain: List[Block] = []
        self._make_genesis()

    def _make_genesis(self):
        txs = [{
            "type": "genesis",
            "to": TARGET_ADDRESS,
            "amount": 50.0,
            "note": "Genesis allocation (toy chain)"
        }]
        root = merkle_root(txs)
        block = Block(
            index=0,
            timestamp=time.time(),
            previous_hash="0"*64,
            nonce=0,
            difficulty=self.difficulty,
            transactions=txs,
            merkle_root=root
        )
        self._mine(block)
        self.chain.append(block)

    def add_block(self, transactions: List[dict]):
        prev = self.chain[-1]
        root = merkle_root(transactions)
        block = Block(
            index=prev.index + 1,
            timestamp=time.time(),
            previous_hash=prev.hash(),
            nonce=0,
            difficulty=self.difficulty,
            transactions=transactions,
            merkle_root=root
        )
        self._mine(block)
        self.chain.append(block)

    def _mine(self, block: Block):
        target_prefix = "0" * self.difficulty
        while True:
            h = block.hash()
            if h.startswith(target_prefix):
                break
            block.nonce += 1

# 6 blocks, each paying to your address -----------------------

if __name__ == "__main__":
    random.seed(42)
    chain = TinyChain(difficulty=2)  # increase to 3 if you want it tougher

    # Create 5 more blocks (total 6 including genesis)
    for height in range(1, 6):
        # Simulated transactions; always include one that pays to your address
        txs = [
            {
                "type": "coinbase",
                "to": TARGET_ADDRESS,          # miner reward to your address (toy)
                "amount": 6.25,                # arbitrary demo amount
                "note": f"Block {height} reward"
            },
            {
                "type": "payment",
                "from": f"demo_sender_{height}",
                "to": TARGET_ADDRESS,
                "amount": round(0.01 * height, 8),
                "note": f"Demo payment #{height} to {TARGET_ADDRESS}"
            },
            # a couple of extra fake txs for flavor
            {
                "type": "payment",
                "from": f"user_{height}_A",
                "to": f"user_{height}_B",
                "amount": round(random.uniform(0.001, 0.02), 8),
                "note": "Peer-to-peer"
            },
            {
                "type": "payment",
                "from": f"user_{height}_C",
                "to": TARGET_ADDRESS if height % 2 == 0 else f"user_{height}_D",
                "amount": round(random.uniform(0.001, 0.02), 8),
                "note": "Mixed flow"
            }
        ]
        chain.add_block(txs)

    # Pretty-print the 6 blocks
    for b in chain.chain:
        print("="*80)
        print(f"Block #{b.index}")
        print(f"Timestamp     : {time.strftime('%Y-%m-%d %H:%M:%S', time.localtime(b.timestamp))}")
        print(f"Prev Hash     : {b.previous_hash}")
        print(f"Merkle Root   : {b.merkle_root}")
        print(f"Nonce         : {b.nonce}")
        print(f"Difficulty    : {b.difficulty} (leading zeros)")
        print(f"Block Hash    : {b.hash()}")
        print("Transactions  :")
        for tx in b.transactions:
            print("  -", json.dumps(tx, separators=(",", ":"), sort_keys=True))



import time, json, random, hashlib

TARGET_LEN = 15  # indexes 0..14

def make_dummy_txs(i: int):
    return [
        {"from": "coinbase", "to": f"miner{i}", "amount": 50, "type": "reward"},
        {"from": f"user{i%3}", "to": f"user{(i+1)%3}", "amount": i * 10}
    ]

def mine_block_object(prev_block, index, transactions, difficulty):
    Block = type(prev_block)  # reuse your existing Block class
    # Create a new block; adapt the constructor if yours differs
    b = Block(
        index=index,
        timestamp=int(time.time()),
        transactions=transactions,
        previous_hash=prev_block.hash(),
        difficulty=difficulty,
        merkle_root=None  # if your Block computes this itself, None/omit is fine
    )

    # Simple PoW: find nonce so that hash starts with N zeros
    prefix = "0" * b.difficulty
    b.nonce = 0
    while True:
        h = b.hash()
        if h.startswith(prefix):
            break
        b.nonce += 1
    return b

# --- Grow the chain to 15 blocks (0..14) ---
while len(chain.chain) < TARGET_LEN:
    i = len(chain.chain)
    prev = chain.chain[-1]
    difficulty = getattr(prev, "difficulty", 4)  # fallback if not present
    txs = make_dummy_txs(i)
    new_b = mine_block_object(prev, i, txs, difficulty)
    chain.chain.append(new_b)

# --- Pretty-print up to block #14 ---
for b in chain.chain[:TARGET_LEN]:
    print("="*80)
    print(f"Block #{b.index}")
    print(f"Timestamp     : {time.strftime('%Y-%m-%d %H:%M:%S', time.localtime(b.timestamp))}")
    print(f"Prev Hash     : {b.previous_hash}")
    print(f"Merkle Root   : {b.merkle_root}")
    print(f"Nonce         : {b.nonce}")
    print(f"Difficulty    : {b.difficulty} (leading zeros)")
    print(f"Block Hash    : {b.hash()}")
    print("Transactions  :")
    for tx in b.transactions:
        print("  -", json.dumps(tx, separators=(',', ':'), sort_keys=True))
