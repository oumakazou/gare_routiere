import React, { useState, useMemo } from 'react';
import { motion, AnimatePresence } from 'framer-motion';
import { MapPin, Calendar, Search, RotateCcw, ArrowRight, Loader2 } from 'lucide-react';jr6
// Define CITY_PRICES and cities outside the component for better performance and clarity
const CITY_PRICES = {
    'Casablanca': 180, 'Rabat': 150, 'Fès': 45, 'Marrakech': 250,
    'Tanger': 170, 'Agadir': 300, 'Oujda': 65, 'Meknès': 50,
    'Nador': 120, 'Tétouan': 160, 'Al Hoceima': 140, 'Kenitra': 130,
    'El Jadida': 200, 'Safi': 240, 'Errachidia': 180, 'Dakhla': 650,
    'Laayoune': 500, 'Béni Mellal': 160, 'Khouribga': 140, 'Settat': 190
};
// The 'cities' array is derived from CITY_PRICES and sorted alphabetically. Taza is intentionally excluded as a destination since it's the fixed departure.
const cities = Object.keys(CITY_PRICES).sort((a, b) => a.localeCompare(b));

const TransportSearch = () => {
    const [destination, setDestination] = useState('');
    const [date, setDate] = useState('');
    const [isLoading, setIsLoading] = useState(false);

    const price = useMemo(() => {
        return destination ? CITY_PRICES[destination] : 0;
    }, [destination]);

    const handleSearch = (e) => {
        e.preventDefault();
        if (!destination || !date) { // Disable search if destination or date is not selected
            // Optionally, add a visual cue for missing fields
            return;
        }
        setIsLoading(true);
        // Simulate API call
        // In a real application, you would navigate or display search results here
        setTimeout(() => setIsLoading(false), 1500); // Simulate API call duration
    };

    const handleReset = () => {
        setDestination('');
        setDate('');
    };

    const containerVariants = {
        hidden: { opacity: 0, y: 20 }, // Initial state for animation
        visible: {
            opacity: 1, 
            y: 0,
            transition: { duration: 0.6, staggerChildren: 0.1 }
        }
    };

    const itemVariants = {
        hidden: { opacity: 0, x: -10 }, // Initial state for individual items
        visible: { opacity: 1, x: 0 }
    };

    return (
        <motion.section 
            initial="hidden"
            animate="visible"
            variants={containerVariants}
            className="w-full max-w-6xl mx-auto p-4 md:p-8"
        >
            <div className="bg-white/80 backdrop-blur-xl rounded-[2.5rem] p-8 shadow-2xl border border-slate-100 relative overflow-hidden">
                {/* Decorative background element */}
                <div className="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 bg-blue-50 rounded-full blur-3xl opacity-50 pointer-events-none" />
                
                <div className="relative z-10">
                    <div className="mb-8">
                        <h2 className="text-3xl font-bold text-slate-900 tracking-tight">Réserver votre trajet</h2>
                        <p className="text-slate-500 mt-2 font-medium">Départs quotidiens depuis la gare de Taza</p>
                    </div>

                    <form onSubmit={handleSearch} className="grid gap-6 lg:grid-cols-4 items-end">
                        {/* Departure - Fixed */}
                        <motion.div variants={itemVariants} className="space-y-2">
                            <label htmlFor="departure-city" className="flex items-center gap-2 text-sm font-semibold text-slate-700 ml-1">
                                <MapPin className="w-4 h-4 text-blue-600" />
                                Départ
                            </label>
                            <div className="relative group">
                                <input
                                    id="departure-city" // Added id for accessibility
                                    type="text" 
                                    value="Taza" 
                                    disabled 
                                    className="w-full bg-slate-50 border-2 border-slate-100 text-slate-500 rounded-2xl px-5 py-4 cursor-not-allowed font-semibold transition-all duration-300"
                                />
                                <div className="absolute right-4 top-1/2 -translate-y-1/2 text-[10px] font-bold uppercase tracking-wider text-blue-600 bg-blue-50 px-2 py-1 rounded-md">
                                    Fixe
                                </div>
                            </div>
                        </motion.div>

                        {/* Destination - Dynamic Select */}
                        <motion.div variants={itemVariants} className="space-y-2">
                            <label htmlFor="destination-city" className="flex items-center gap-2 text-sm font-semibold text-slate-700 ml-1">
                                <ArrowRight className="w-4 h-4 text-blue-600" />
                                Destination
                            </label>
                            <select
                                id="destination-city" // Added id for accessibility
                                value={destination}
                                onChange={(e) => setDestination(e.target.value)}
                                className="w-full bg-white border-2 border-slate-200 text-slate-900 rounded-2xl px-5 py-4 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all duration-300 hover:border-slate-300 appearance-none cursor-pointer font-medium"
                                required
                            >
                                <option value="" disabled>Vers quelle ville ?</option>
                                {cities.map(city => (
                                    <option key={city} value={city}>{city}</option>
                                ))}
                            </select>
                        </motion.div>

                        {/* Date Picker */}
                        <motion.div variants={itemVariants} className="space-y-2">
                            <label htmlFor="travel-date" className="flex items-center gap-2 text-sm font-semibold text-slate-700 ml-1">
                                <Calendar className="w-4 h-4 text-blue-600" />
                                Date de voyage
                            </label>
                            <input
                                id="travel-date" // Added id for accessibility
                                type="date" 
                                value={date}
                                onChange={(e) => setDate(e.target.value)}
                                className="w-full bg-white border-2 border-slate-200 text-slate-900 rounded-2xl px-5 py-4 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all duration-300 hover:border-slate-300 font-medium"
                                required
                            />
                        </motion.div>

                        {/* Search Action */}
                        <motion.div variants={itemVariants} className="flex gap-3">
                            <motion.button
                                type="submit"
                                disabled={isLoading || !destination || !date} // Disable if destination or date is not selected
                                whileHover={{ scale: 1.02 }}
                                whileTap={{ scale: 0.98 }}
                                className="flex-1 bg-slate-900 hover:bg-black text-white font-bold py-4 rounded-2xl shadow-xl shadow-slate-200 transition-all duration-300 flex items-center justify-center gap-3 group disabled:opacity-70 disabled:cursor-not-allowed"
                            >
                                {isLoading ? (
                                    <Loader2 className="w-5 h-5 animate-spin" />
                                ) : (
                                    <>
                                        <Search className="w-5 h-5 group-hover:scale-110 transition-transform" />
                                        Rechercher
                                    </>
                                )}
                            </motion.button>
                            
                            <motion.button
                                type="button"
                                onClick={handleReset}
                                disabled={isLoading} // Disable reset button while loading
                                whileHover={{ scale: 1.05, rotate: -10 }}
                                whileTap={{ scale: 0.95 }}
                                className="p-4 bg-slate-100 text-slate-600 rounded-2xl hover:bg-slate-200 transition-colors"
                                title="Réinitialiser"
                            >
                                <RotateCcw className="w-5 h-5" />
                            </motion.button>
                        </motion.div>
                    </form>

                    {/* Price Indicator Area */}
                    <AnimatePresence>
                        {destination && (
                            <motion.div 
                                initial={{ opacity: 0, height: 0, marginTop: 0 }} // Use marginTop for Framer Motion
                                animate={{ opacity: 1, height: 'auto', marginTop: 24 }}
                                exit={{ opacity: 0, height: 0, mt: 0 }}
                                className="flex flex-wrap items-center justify-between border-t border-slate-100 pt-6 mt-6"
                            >
                                <div className="flex items-center gap-4">
                                    <div className="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center">
                                        <span className="text-green-600 text-xl font-bold">DH</span>
                                    </div>
                                    <div>
                                        <p className="text-xs font-bold text-slate-400 uppercase tracking-widest">Tarif fixe assuré</p>
                                        <p className="text-slate-900 font-semibold">Taza <ArrowRight className="inline w-3 h-3 mx-1" /> {destination}</p>
                                    </div>
                                </div>
                                <div className="text-right">
                                    <span className="text-3xl font-black text-slate-900">{price}</span>
                                    <span className="text-slate-500 font-bold ml-1">MAD</span>
                                </div>
                            </motion.div>
                        )}
                    </AnimatePresence>
                </div>
            </div>

            {/* Quick Stats / Info Row */}
            <div className="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                {[
                    { label: 'Trajets directs', val: '100%', icon: '🚀' },
                    { label: 'Villes couvertes', val: cities.length, icon: '📍' },
                    { label: 'Prix stables', val: 'Garanti', icon: '🛡️' }
                ].map((stat, i) => (
                    <motion.div 
                        key={i}
                        whileHover={{ y: -5 }}
                        className="bg-white p-5 rounded-3xl shadow-sm border border-slate-100 flex items-center gap-4"
                    >
                        <span className="text-2xl">{stat.icon}</span>
                        <div>
                            <p className="text-xs font-bold text-slate-400 uppercase tracking-wider">{stat.label}</p>
                            <p className="text-lg font-bold text-slate-900">{stat.val}</p>
                        </div>
                    </motion.div>
                ))}
            </div>
        </motion.section>
    );
};

export default TransportSearch;

/* 
   Integration steps for Tailwind config:
   Ensure your tailwind.config.js includes the forms plugin if needed,
   though this uses custom classes for a more premium look.

   Required packages:
   npm install framer-motion lucide-react

   Key Design Principles Applied:
   - Glassmorphism backdrop-blur-xl
   - Soft rounded corners (rounded-[2.5rem])
   - High-contrast typography (Inter/Slate palette)
   - Interactive feedback (scale, hover, focus rings)
   - Logical Information Hierarchy
   - Fixed Departure Logic (Business Rule)
*/
